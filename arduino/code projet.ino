/*
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #  
#                    Installation :                                   # 
#                                                                     # 
# NodeMCU ESP8266/ESP12E    RFID MFRC522 / RC522                      #
#         D2       <---------->   SDA/SS                              #
#         D5       <---------->   SCK                                 #
#         D7       <---------->   MOSI                                #
#         D6       <---------->   MISO                                #
#         GND      <---------->   GND                                 #
#         D1       <---------->   RST                                 #
#         3V/3V3   <---------->   3.3V                                #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
*/

//---------------------------------------- NodeMCU ESP8266 librairie---------------------------------------------------------------------------------------------------------------//
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <Servo.h>


ESP8266WiFiMulti WiFiMulti;

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------SPI et MFRC522 librairies-------------------------------------------------------------------------------------------------------------//
//----------------------------------------Librairies MFRC522 à installer
#include <SPI.h>
#include <MFRC522.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

#define SS_PIN D2  //SDA / SS connecté à la pine de sortie D2
#define RST_PIN D1  //RST connecté à la pine de sortie D1
MFRC522 mfrc522(SS_PIN, RST_PIN);  //instance MFRC522.

#define ON_Board_LED 2  //on selectionne une led LED sur la carte esp8266

//----------------------------------------SSID and Password of your WiFi router-------------------------------------------------------------------------------------------------------------//
//const char* ssid = "AndroidAP9798";
//const char* password = "12345678";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

ESP8266WebServer server(80);  //--> Server on port 80

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID; //UID variable globale

Servo monServomoteur;   // Creation instance servo


//-----------------------------------------------------------------------------------------------SETUP--------------------------------------------------------------------------------------//
void setup() {

  // Attache le servomoteur à la broche D9
  monServomoteur.attach(D4);

  
  Serial.begin(9600); //--> Initialisation Moniteur série
  SPI.begin();      //--> Inititialisation bus SPI
  mfrc522.PCD_Init(); //--> Inititialisation carte MFRC522

  delay(500);

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("AndroidAP9798", "12345678");
  
  Serial.println("");
    
  pinMode(ON_Board_LED,OUTPUT); 
  digitalWrite(ON_Board_LED, HIGH); //--> Led off sur la Esp

  
  //----------------------------------------Attente de la connexion 
  Serial.print("Connexion");
  while (WiFiMulti.run() != WL_CONNECTED) {
    Serial.print(".");
    //----------------------------------------Si connexion alors la led clignote.
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
  }
  digitalWrite(ON_Board_LED, HIGH); //--> et on eteint la led.
  
  //----------------------------------------On affiche l'adresse ip locale de l'esp8266
  Serial.println("");
  Serial.print("Connexion réussie à : ");
  Serial.print("Adress IP: ");
  Serial.println(WiFi.localIP());

  Serial.println("SVP approchez la carte de l'étudiant pour voir UID !");
  Serial.println("");
   
  monServomoteur.write(0); // Position initale du servo

}
void loop() {

  readsuccess = getid();
 
  if(readsuccess) {  //Si carte lue
    
    digitalWrite(ON_Board_LED, LOW);
     
    String UIDresultSend;
    String postData;
    UIDresultSend = StrUID; 
    
    WiFiClient client;
    HTTPClient http;    //Declare object of class HTTPClient
    
     
    http.begin(client, "http://192.168.43.222/projet_iot/getUID.php"); //requete finale
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header

    //Post Data
    postData = "UIDresult=" + UIDresultSend;
    
    int httpCode = http.POST(postData);   //On envoie la requete avec la méthode POST
    String payload = http.getString();    //On recupere la reponse payload (réponse HTTP)
  
    Serial.println(UIDresultSend);
    Serial.println(httpCode);   //Code retour HTTP
    Serial.println(payload);    ///:Affiche la reponse payload
  
    String newPayload = payload;

    newPayload.trim(); //Version de la chaîne avec tous les espaces blancs de début et de fin supprimés.
 
    if(newPayload=="Porte ouverte")
    {
                
      monServomoteur.write(180);
      delay(2000);
      monServomoteur.write(0);
      delay(1000);

      
    }
    else if (newPayload=="Pas enregistré"){
      
    }
    
    http.end();  //Close connection
       // Serial.println(UIDresultSend);
    delay(1000);
    digitalWrite(ON_Board_LED, HIGH);
  }
}

//----------------------------------------fonction pour lire et obtenir l'UID d'une carte étudiante---------------------------------------------------------------------------------//
int getid() {  
  if(!mfrc522.PICC_IsNewCardPresent()) { //Attente d'une carte RFID (Si pas de tag)
    return 0;
  }
  if(!mfrc522.PICC_ReadCardSerial()) { //Récupération des informations de la carte RFID (Si pas d'info sur carte)
    return 0;
  }
 
  
  Serial.print("UID : ");
  
  for(int i=0;i<4;i++){
    readcard[i]=mfrc522.uid.uidByte[i]; //On stock l'UID de la carte
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}

//----------------------------------------tableau vers String------------------------------------------------------------------------------//
void array_to_string(byte array[], unsigned int len, char buffer[]) {
    for (unsigned int i = 0; i < len; i++)
    {
        byte nib1 = (array[i] >> 4) & 0x0F;
        byte nib2 = (array[i] >> 0) & 0x0F;
        buffer[i*2+0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
        buffer[i*2+1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
    }
    buffer[len*2] = '\0';
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//