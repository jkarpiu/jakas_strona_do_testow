import requests
import json
import selenium
import urllib.request
import time
from selenium import webdriver
from bs4 import BeautifulSoup
from selenium.webdriver.chrome.options import Options


#tablice
all_odpowiedzi = []
all_pytania =  []
id_pytanie = 1
id_odpowiedz = 1


def sprawdzanko(tresc):
    for element in all_pytania:
        if (element['tresc'] == tresc):
            return True
    return False

#otwieranie stronki
for i in range(6):
    options = Options()
    options.add_argument("--start-maximized")
    driver = webdriver.Chrome(chrome_options=options, executable_path='C:\Python39\chromedriver.exe')
    driver.get("https://egzamin-informatyk.pl/testy-inf02-ee08-sprzet-systemy-sieci/")
    driver.execute_script("top.window.onbeforeunload = null;")
    driver.find_element_by_id("hcks").click()
    time.sleep(2)
    driver.find_element_by_id("sprawdz").click()
    driver.implicitly_wait(5)

    #wczytywanie html
    odpowiedz = driver.page_source
    soup = BeautifulSoup(odpowiedz, 'html.parser')

    all_divs = driver.find_elements_by_css_selector(".aos-init > div")

    #dziwne rzecczy z divami, przydzielanie obrazka do pytania itpitp
    for index, i in enumerate(all_divs):
        repeat = False
        if (i.get_attribute("class")=="trescE"):
            one_pytanie = {'id': id_pytanie, 'id_dzial': 1, 'image':'', 'tresc': i.text.split('. ', 1)[1]}
            repeat = sprawdzanko(one_pytanie['tresc'])
            if not repeat:
                all_pytania.append(one_pytanie)
            id_pytanie = id_pytanie + 1

        elif i.get_attribute("class")=="obrazek" and not repeat:
            photo = i.find_element_by_class_name("img-responsive").get_attribute("src")
            filename = 'images\pytanie' + str(id_pytanie - 1) + '.jpg'
            all_pytania[-1]['image'] = filename.replace('\\', '/')
            urllib.request.urlretrieve(photo, filename)

        elif i.get_attribute("class")=="odpbad" and not repeat:
            one_odpowiedz = {'id':id_odpowiedz, 'id_pytanie':all_pytania[-1]['id'], 'poprawna':False, 'tresc':i.text.split('. ', 1)[1].capitalize()}
            all_odpowiedzi.append(one_odpowiedz)
            id_odpowiedz = id_odpowiedz + 1

        elif i.get_attribute("class")=="odpgood" and not repeat:
            one_odpowiedz = {'id':id_odpowiedz, 'id_pytanie':all_pytania[-1]['id'], 'poprawna':True, 'tresc':i.text.split('. ', 1)[1].capitalize()}
            all_odpowiedzi.append(one_odpowiedz)
            id_odpowiedz = id_odpowiedz + 1


    #zapisywanie pytan do zapis.txt
    f1 = open("zapis_pytan.txt", "w", encoding='utf8')
    f1.write(f"{all_pytania}\n")
    f1.close()
    #zapisywanie odpowiedzi do odpowiedzi.txt
    f2 = open("zapis_odpowiedzi.txt", "w", encoding='utf8')
    f2.write(f"{all_odpowiedzi}\n")
    f2.close()
    print(len(all_pytania))
    print(id_pytanie)

