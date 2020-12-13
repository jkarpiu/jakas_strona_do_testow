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
for g in range(10000):
    options = Options()
    options.add_argument("--start-maximized")
    options.add_argument('--headless')
    options.add_argument('--no-sandbox')
    options.add_argument('--disable-dev-shm-usage')
    driver = webdriver.Chrome(chrome_options=options, executable_path='/usr/bin/chromedriver')
    print("Łącze się z oknem przeglądarki")
    driver.get("https://egzamin-informatyk.pl/testy-inf02-ee08-sprzet-systemy-sieci/")
    time.sleep(5)
    driver.execute_script("top.window.onbeforeunload = null;")
    driver.find_element_by_id("hcks").click()
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
                print("Pobieram pytanie: ")
                print(one_pytanie)
            id_pytanie = id_pytanie + 1

        elif i.get_attribute("class")=="obrazek" and not repeat:
            photo = i.find_element_by_class_name("img-responsive").get_attribute("src")
            filename = '\images_dzial2\pytanie' + str(id_pytanie - 1) + '.jpg'
            print("Pobieram obrazek: " + filename)
            all_pytania[-1]['image'] = filename.replace('\\', '/')
            urllib.request.urlretrieve(photo, filename)

        elif i.get_attribute("class")=="odpbad" and not repeat:
            one_odpowiedz = {'id':id_odpowiedz, 'id_pytanie':all_pytania[-1]['id'], 'poprawna':False, 'tresc':i.text.split('. ', 1)[1].capitalize()}
            print("Pobieram odpowiedź")
            print(one_odpowiedz)
            all_odpowiedzi.append(one_odpowiedz)
            id_odpowiedz = id_odpowiedz + 1

        elif i.get_attribute("class")=="odpgood" and not repeat:
            one_odpowiedz = {'id':id_odpowiedz, 'id_pytanie':all_pytania[-1]['id'], 'poprawna':True, 'tresc':i.text.split('. ', 1)[1].capitalize()}
            print("Pobieram odpowiedź")
            print(one_odpowiedz)
            all_odpowiedzi.append(one_odpowiedz)
            id_odpowiedz = id_odpowiedz + 1


    driver.quit()
    print("\n Zapisywanie plików... \n ")
    #zapisywanie pytan do zapis.txt
    f1 = open("zapis_pytan_dzial1.json", "w")
    json.dump (all_pytania, f1, ensure_ascii=False, sort_keys=True, indent=4)
    f1.close()
    #zapisywanie odpowiedzi do odpowiedzi.txt
    f2 = open("zapis_odpowiedzi_dzial1.json", "w")
    json.dump(all_odpowiedzi, f2, ensure_ascii=False, sort_keys=True, indent=4)
    f2.close()
    print("\n-----------------------------------------")
    print("Ilość zapisanych pytań: " + str(len(all_pytania)))
    print("Najwyższe id pytania: " + str(id_pytanie - 1))
    print("Ilość odpowiedzi: " + str(len(all_odpowiedzi)))
    print("Powtórek: " + str(g + 1))
    print("-----------------------------------------\n")

