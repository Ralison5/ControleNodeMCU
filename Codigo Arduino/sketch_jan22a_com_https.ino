//----------------------------------------Include the NodeMCU ESP8266 Library---------------------------------------------------------------------------------------------------------------//
//----------------------------------------see here: https://www.youtube.com/watch?v=8jMr94B8iN0 to add NodeMCU ESP8266 library and board
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------Include the SPI and MFRC522 libraries-------------------------------------------------------------------------------------------------------------//
//----------------------------------------Download the MFRC522 / RC522 library here: https://github.com/miguelbalboa/rfid
#include <SPI.h>
#include <FS.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <LiquidCrystal_I2C.h>
#include <WiFiClientSecureBearSSL.h>



const char fingerprint[] PROGMEM = "F3:1B:B7:47:29:59:39:C1:91:7D:B4:61:DA:4D:EC:0D:8C:E1:E7:C1";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

#define SS_PIN D4  //--> SDA / SS is connected to pinout D2
#define RST_PIN D3  //--> RST is connected to pinout D1
int lcdColumns = 16;
int lcdRows = 2;
MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);  
WiFiClient client;
#define ON_Board_LED 2  //--> Defining an On Board LED, used for indicators when the process of connecting to a wifi router
#define trava D0 //a trava
#define Buzzer D8 //o buzzer
//----------------------------------------SSID and Password of your WiFi router-------------------------------------------------------------------------------------------------------------//
const char* ssid = "Leila";
const char* password = "31059611";
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

ESP8266WebServer server(80);  //--> Server on port 80

int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;
int httpCode=0;
void atualiza_local(String x);
int getid();
int imprimir(String payload);
void control(int valor);
void verificador();
void  mensagem();

//-----------------------------------------------------------------------------------------------SETUP--------------------------------------------------------------------------------------//


void setup() {
  // initialize LCD
  lcd.init();
  // turn on LCD backlight                      
  lcd.backlight();
  Serial.begin(115200); //--> Initialize serial communications with the PC
  SPI.begin();      //--> Init SPI bus
  mfrc522.PCD_Init(); //--> Init MFRC522 card
  pinMode(trava, OUTPUT);
  pinMode(Buzzer, OUTPUT);
  noTone(Buzzer);
  delay(500);

  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");
    
  pinMode(ON_Board_LED,OUTPUT); 
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off Led On Board

  //----------------------------------------Wait for connection

  lcd.setCursor(3,0);
  // print message
  lcd.print("CONECTANDO");
  lcd.setCursor(2,1);
  // print message
  lcd.print("NA REDE WIFI!");
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    //----------------------------------------Make the On Board Flashing LED on the process of connecting to the wifi router.
    digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);
  }
  if(WiFi.status() == WL_CONNECTED){
  lcd.clear();
  lcd.setCursor(3,0);
  // print message
  lcd.print("CONECTADO");
  lcd.setCursor(2,1);
  // print message
  lcd.print("NA REDE WIFI!");
  delay(1500);
  lcd.clear();
    
  }
  digitalWrite(ON_Board_LED, HIGH); //--> Turn off the On Board LED when it is connected to the wifi router.
   digitalWrite(trava, LOW);
  //----------------------------------------If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());

  Serial.println("Please tag a card or keychain to see the UID !");
  Serial.println("");

  mensagem();
  
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------------------LOOP---------------------------------------------------------------------------------------//
unsigned long anterior_tarefa = 0;
unsigned long contador=0;
int informacao = 0;

void loop() {
   
   if (millis() - contador >  180000){
   lcd.clear();
   Serial.printf("\nentrou\n");
   verificador();
   contador = millis();
   delay(1000);
   lcd.clear();
   mensagem();
  }
  // put your main code here, to run repeatedly
  readsuccess = getid();
  //mensagem(readsuccess);
   
 digitalWrite(ON_Board_LED, LOW);
 if(readsuccess){

   String UIDresultSend, postData,local;
   UIDresultSend = StrUID;
   Serial.println(UIDresultSend);
 if(WiFi.status() == WL_CONNECTED){
 std::unique_ptr<BearSSL::WiFiClientSecure>client(new BearSSL::WiFiClientSecure);
 client->setFingerprint(fingerprint);
    // Or, if you happy to ignore the SSL certificate, then use the following line instead:
    //client->setInsecure();

   HTTPClient http;
   
   local="3410";
 
    //Post Data
    postData = UIDresultSend;
    Serial.println(postData);
    http.begin(*client,"https://controlenodemcu.000webhostapp.com/consult.php?tag="+UIDresultSend+"&local="+local);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //Specify content-type header"
    httpCode = http.POST(postData);   //Send the request
     //httpCode = https.GET();
    

    
   if(httpCode > 0){

   // Obteve resposta do servidor
   Serial.printf("[HTTP] POST ... código: %d\n",httpCode);

   if(httpCode == HTTP_CODE_OK){
   
    const String& payload = http.getString();    //Get the response payload       
    //Serial.println(httpCode);   //Print HTTP return code
    String recebe=payload;
    
   int valor = imprimir(recebe);
   control(valor);
   http.end();  //Close connection
   delay(1000);
   digitalWrite(ON_Board_LED, HIGH);
  }else{

  Serial.printf("[HTTP] POST... código xxxx: %d\n", httpCode);
  http.end();
                  
        }
  
    }

}

Serial.printf("[HTTP] POST... código: %d\n", httpCode);
 


     }

}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------Procedure for reading and obtaining a UID from a card or keychain---------------------------------------------------------------------------------//
int getid() {  
  if(!mfrc522.PICC_IsNewCardPresent()) {
    return 0;
  }
  if(!mfrc522.PICC_ReadCardSerial()) {
    return 0;
  }
 
  Serial.print("THE UID OF THE SCANNED CARD IS : ");
  
  for(int i=0;i<4;i++){
    readcard[i]=mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//



//----------------------------------------Procedure to change the result of reading an array UID into a string------------------------------------------------------------------------------//
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


//--------------------------------Procedimento de impressão-----------------------------//
int imprimir(String payload){

Serial.print("received payload:\n<<");
int i,j=0;
char v[100];
        
for(i=0;i<payload.length();i++){
       
if(payload[i] >=65 && payload[i]<=90 || payload[i] >=97 && payload[i]<=122 || payload[i]==32 ){
   v[j]=payload[i];
   j++;
     }
        }
 v[j]='\0';
char  recebe[j];
int cont = 0;       
for(i=0;i<j;i++){

recebe[i]=v[i]; 
cont = cont + 1;       
    }
 recebe[j]='\0';
       
Serial.printf("%s\n",recebe);
Serial.printf("%d",cont);
Serial.println(">>");
return cont;
        
}

//--------------------------------------------------------------------------------------//

void control(int valor){
int principal = 8;

if(principal == valor){

Serial.println("Authorized access");
    Serial.println();
    delay(500);
    digitalWrite(trava, HIGH);

   lcd.clear();
  lcd.setCursor(5,0);
  // print message
  lcd.print("ACESSO");
  lcd.setCursor(4,1);
  // print message
  lcd.print("LIBERADO!");
     tone(Buzzer,1000);
     delay(2000);
     digitalWrite(trava, LOW);
     noTone(Buzzer);
     lcd.clear();
     mensagem();
      
    
}else{

  delay(500);
   tone(Buzzer,1000);
    lcd.clear();
  lcd.setCursor(5,0);
  // print message
  lcd.print("ACESSO");
  lcd.setCursor(5,1);
  // print message
  lcd.print("NEGADO!");
  delay(2000);
  lcd.clear();
  noTone(Buzzer);
   mensagem();
    
  
}


return   ; 
}


void mensagem(){

lcd.setCursor(4,0);
  // print message
  lcd.print("EM MODO");
  lcd.setCursor(3,1);
  // print message
  lcd.print("DE ESPERA!");

return   ;
}
