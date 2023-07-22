from flask import Flask, jsonify, request
import requests
import json

KEY = "4D8935BF-93A5-40B2-9E0F-730C3CAC118F"

app = Flask(__name__)

# Define a simple route
@app.route('/')
def hello():
    return 'Hello, World!'


#Recojo de datos de usuarios
#------------------------------------------------------------------------------------
@app.route('/api/usuarios', methods=['POST'])
def sdp_usuarios():
    authtoken = request.form.get('authtoken')
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    response_s_auth = requests.post("http://localhost:5001/api/verificacion",data={'authtoken':authtoken},verify=False)
    try:
        print(response_s_auth.json()['userid'])
        if(response_s_auth.json()['userid']==0):
            response_sdp = requests.get("https://localhost:8080/api/v3/reports/302/execute",headers={"authtoken":KEY},verify=False)
            return response_sdp.json()
        else:
            return {'error':'authtoken invalido'}
    except:
        return {'error':response_s_auth.json()['error']}
    
#------------------------------------------------------------------------------------

#Recoje lista de solicitudes
#------------------------------------------------------------------------------------
@app.route('/api/solicitud_lista', methods=['POST'])
def sdp_solicitud_lista():
    authtoken = request.form.get('authtoken')
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    response_s_auth = requests.post("http://localhost:5001/api/verificacion",data={'authtoken':authtoken},verify=False)
    
    try:
        input_datax = {
            'list_info':{
                'sort_field':"id",
                "row_count": 20,
                'sort_order':"asc",
                'get_total_count':True,
                'search_fields':{
                    'requester.id':str(response_s_auth.json()['userid'])
                }
            }
        }
        response = requests.get("https://localhost:8080/api/v3/requests",headers={"authtoken":KEY},params={'input_data': json.dumps(input_datax)},verify=False)
        return jsonify(response.json())
    except:
        return {'error':response_s_auth.json()['error']}
#------------------------------------------------------------------------------------

#Recojo de informacion de una solicitud
#------------------------------------------------------------------------------------
@app.route('/api/solicitud_detalle/<int:id>', methods=['POST'])
def sdp_solicitud_detalle(id):
    authtoken = request.form.get('authtoken')
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    response_s_auth = requests.post("http://localhost:5001/api/verificacion",data={'authtoken':authtoken},verify=False)
    
    try:
        response = requests.get("https://localhost:8080/api/v3/requests/"+str(id),headers={"authtoken":KEY},verify=False)
        print(type(response.json()['request']['requester']['id']))
        print(type(response_s_auth.json()['userid']))
        if(response.json()['request']['requester']['id']==str(response_s_auth.json()['userid'])):
            return jsonify(response.json())
        elif(str(5)==str(response_s_auth.json()['userid'])):
            return jsonify(response.json())
        else:
            return {'error':"Sin permisos para realizar operacion"}
    except:
        return {'error':response_s_auth.json()['error']}
#------------------------------------------------------------------------------------

#Crea solicitud
#------------------------------------------------------------------------------------
@app.route('/api/solicitud_crea', methods=['POST'])
def sdp_solicitud_crea():
    authtoken = request.form.get('authtoken')
    if not authtoken:
        return jsonify({'error': 'Missing fields'}), 400
    response_s_auth = requests.post("http://localhost:5001/api/verificacion",data={'authtoken':authtoken},verify=False)
    
    try:
        input_data ={
            "request":{
                "subject": request.form.get('asunto'),
                "description": request.form.get('descripcion'),
                "requester":{
                    "id": str(response_s_auth.json()['userid']),
                },
                "status": {
                    "name": "Open"
                }
            }
        }
        response = requests.post("https://localhost:8080/api/v3/requests",headers={"authtoken":KEY},data={'input_data': json.dumps(input_data)},verify=False)
        return jsonify(response.json())
    except:
        return {'error':response_s_auth.json()['error']}
#------------------------------------------------------------------------------------


# Define a route that accepts GET requests

@app.route('/api/data/<int:num>', methods=['GET'])
def get_data(num):
    data = {'name': 'John', 'age': num, 'city': 'New York'}
    return jsonify(data)


@app.route('/api/number', methods=['POST'])
def process_number():
    data = request.get_json()
    num = data.get('number')
    
    if num is None:
        return jsonify({'error': 'Invalid payload'}), 400
    
    result = {'number': num, 'square': num**2}
    return jsonify(result)

@app.route('/api/submit', methods=['POST'])
def process_form():
    name = request.form.get('name')
    age = request.form.get('age')
    
    if not name or not age:
        return jsonify({'error': 'Missing fields'}), 400
    
    result = {'name': name, 'age': age}
    return jsonify(result)


@app.route('/api/solicitudesadsfasdf', methods=['POST'])
def process_sdp():
    requesterid = request.form.get('id')
    
    if not requesterid:
        return jsonify({'error': 'Missing fields'}), 400
    
    url = "https://localhost:8080/api/v3/requests"
    headers ={"authtoken":KEY}

    input_datax = {
        'list_info':{
            'sort_field':"id",
            'sort_order':"asc",
            'get_total_count':True,
            'search_fields':{
                'requester.id':str(requesterid)
            }
        }
    }
    params = {'input_data': json.dumps(input_datax)}
    response = requests.get(url,headers=headers,params=params,verify=False)
    
    return jsonify(response.json())


@app.route('/endpoint', methods=['POST'])
def endpoint():
    header_value = request.headers.get('Header-Name')
    # Use the header value as needed
    
    return 'Received header: {}'.format(header_value)










# Run the Flask application
if __name__ == '__main__':
    app.run()
