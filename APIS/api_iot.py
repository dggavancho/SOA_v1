from flask import Flask, jsonify, request
import requests
from gtts import gTTS
from playsound import playsound
from pygame import mixer
import time

app = Flask(__name__)

# Default
@app.route('/')
def default():
    print("hola mundo")
    return jsonify({'hola':'mundo'})

# Default
@app.route('/notificaciones/')
def notificaciones():
    employeeid = request.args.get('employeeid')
    requestid = request.args.get('requestid')
    authtoken = requests.post("http://localhost:5001/api/login",data={'employeeid': employeeid},verify=False).json()['authtoken']
    solicitud = requests.post("http://localhost:5000/api/solicitud_detalle/"+str(requestid),data={'authtoken': authtoken},verify=False)
    data = solicitud.json()
    idn = data['request']['id']
    sub = data['request']['subject']
    cli = data['request']['requester']['name']
    cad2 = "El cliente "+cli+" solicita "+sub+", solicitud número "+str(idn)
    print(cad2)
    #Crear y guarda 4to sonido
    tts = gTTS(cad2, lang="es")
    tts.save('sound4.mp3')
    #Reproduce 2do sonido
    mixer.init()
    mixer.music.load('sound4.mp3')
    mixer.music.play()
    while(mixer.music.get_busy()):
        time.sleep(1)
    if(mixer.music.get_busy()==False):
        mixer.music.stop()
        mixer.quit()
    return jsonify({'hola':'mundo'})

if __name__ == '__main__':
    app.run(port=5002)