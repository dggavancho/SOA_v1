from flask import Flask, jsonify, request
import requests
import json
import hashlib
import random
from sympy import isprime
import pandas as pd
import mysql.connector
import jwt
from datetime import datetime, timedelta

KEY = "4D8935BF-93A5-40B2-9E0F-730C3CAC118F"
secret = "HXx#pa8)e2vwDbc7q^YsYzR@If@6bqmca7yY*YT%d@exP+NTT+BJz4&x6AQIdAZd"

app = Flask(__name__)


#Funciones necesarias
#------------------------------------------------------------------------------------
def calculate_sha256(input_string):
    # Create a new SHA-256 hash object
    sha256_hash = hashlib.sha256()

    # Convert the input string to bytes and update the hash object
    sha256_hash.update(input_string.encode('utf-8'))

    # Get the hexadecimal representation of the hash as a string
    sha256_hex = sha256_hash.hexdigest()

    return sha256_hex

def generate_random_prime(bit_length):
    while True:
        # Generate a random number with the specified bit length
        rand_num = random.getrandbits(bit_length)

        # Check if the number is prime using the isprime() function from sympy library
        if isprime(rand_num):
            return rand_num

# Generate a JWT token
def generate_token(payload, secret, expiration):
    payload['exp'] = datetime.utcnow() + timedelta(seconds=expiration)
    return jwt.encode(payload, secret, algorithm='HS256')

# Verify and decode a JWT token
def verify_token(token, secret):
    try:
        payload = jwt.decode(token, secret, algorithms=['HS256'])
        return payload
    except jwt.ExpiredSignatureError:
        # Token has expired
        return None
    except jwt.InvalidTokenError:
        # Token is invalid
        return None

def registro(mensaje):
    file_path = 'registro.txt'
    timestamp = datetime.now()
    formatted_timestamp = timestamp.strftime('%Y-%m-%d %H:%M:%S')
    with open(file_path, 'a') as file:
        file.write(formatted_timestamp+" "+str(mensaje)+"\n")

#------------------------------------------------------------------------------------




#Enlace de verificacion
#------------------------------------------------------------------------------------
@app.route('/api/verificacion', methods=['POST'])
def verificacion():
    authtoken = request.form.get('authtoken')
    
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    
    payload = verify_token(authtoken, secret)

    if(payload!=None):
        resultado = {'userid':payload['userid']}
        registro(str(payload['employeeid']+" Exito Verificacion"))
        return resultado
    else:
        registro(str(payload['employeeid']+" Error Verificacion"))
        return {'error':"Token no coincide con ningun usuario"}
#------------------------------------------------------------------------------------    

#Enlace de inicio de sesion
#------------------------------------------------------------------------------------
# Establish a connection to the MySQL server
@app.route('/api/login', methods=['POST'])
def login():
    employeeid = request.form.get('employeeid')
    
    employeeid = "77205384"
    db="soa_s_autenticacion"
    connection = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database=db
    )
    cursor = connection.cursor()

    sql = "select * from usuario where employeeid = %s;"
    values_select = [employeeid]
    cursor.execute(sql, values_select)
    result = cursor.fetchall()
    cursor.execute("DESCRIBE usuario")
    table = cursor.fetchall()
    connection.commit()
    cursor.close()
    connection.close()
    if(len(result)>0):
        columnas = pd.DataFrame(table, columns=['Field', 'Type', 'Null', 'Key', 'Default', 'Extra'])
        payload = dict()
        for i in range(len(columnas['Field'].tolist())):
            payload.update({columnas['Field'].tolist()[i]:result[0][i]})
        expiration = 3600  # Token expiration time in seconds (e.g., 1 hour)
        token = generate_token(payload, secret, expiration)
        registro(str(employeeid+" Exito de inicio de sesion"))
        return({'authtoken':token})
    else:
        registro(str(employeeid+" Error de inicio de sesion"))
        return({'error':"Usuario no encontrado"})
    
    #return
#------------------------------------------------------------------------------------



# Run the Flask application
if __name__ == '__main__':
    app.run(port=5001)
