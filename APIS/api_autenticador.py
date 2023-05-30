from flask import Flask, jsonify, request
import requests
import json
import hashlib
import random
from sympy import isprime
import pandas as pd
import mysql.connector

KEY = "4D8935BF-93A5-40B2-9E0F-730C3CAC118F"

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
#------------------------------------------------------------------------------------




#Enlace de verificacion
#------------------------------------------------------------------------------------
@app.route('/api/verificacion', methods=['POST'])
def verificacion():
    authtoken = request.form.get('authtoken')
    
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    
    db="soa_s_autenticacion"
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database=db
    )
    mycursor = mydb.cursor()
    sql = "select userid from log where token_log = %s;"
    values_select = [authtoken]
    mycursor.execute(sql, values_select)
    result = mycursor.fetchall()
    if(len(result)>0):
        print("existe")
        resultado = {'userid':result[0][0]}
        return resultado
    else:
        return {'error':"Token no coincide con ningun usuario"}
#------------------------------------------------------------------------------------    

#Enlace de inicio de sesion
#------------------------------------------------------------------------------------
# Establish a connection to the MySQL server
@app.route('/api/login', methods=['POST'])
def login():
    employeeid = request.form.get('employeeid')

    db="soa_s_autenticacion"
    connection = mysql.connector.connect(
        host='localhost',
        user='root',
        password='',
        database=db
    )
    cursor = connection.cursor()

    sql = "select userid from usuario where employeeid = %s;"
    values_select = [employeeid]
    cursor.execute(sql, values_select)
    result = cursor.fetchall()
    if(len(result)>0):
        print("existe")
        # Prepara el sha
        bit_length = 1024
        random_prime = generate_random_prime(bit_length)
        sha256 = calculate_sha256(str(random_prime)+str(result[0][0]))
        # Define the INSERT query and values
        insert_query = "INSERT INTO log (userid,token_log) VALUES (%s, %s)"
        values = (result[0][0], sha256)
        cursor.execute(insert_query, values)
        connection.commit()
        cursor.close()
        connection.close()
        return {'authtoken':sha256}
    else:
        connection.commit()
        cursor.close()
        connection.close()
        return {'error':"Usuario no encontrado"}
    #return
#------------------------------------------------------------------------------------



# Run the Flask application
if __name__ == '__main__':
    app.run(port=5001)
