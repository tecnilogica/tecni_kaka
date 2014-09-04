#include <AlphaNumeric_Driver.h>
#include <FileIO.h>

#define NUMBER_OF_DISPLAYS 4
#define SDIPIN 11
#define CLKPIN 13
#define LEPIN 10
#define OEPIN 9

alphaNumeric myDisplay(SDIPIN, CLKPIN, LEPIN, OEPIN, NUMBER_OF_DISPLAYS);

char buf [5];

void setup() {
  
  Bridge.begin();
  FileSystem.begin();

  Serial.begin(9600);

}

void loop () {

  String dataString;
  dataString += getTimeStamp();
  dataString += " = ";

  int sensor = analogRead(0);
  dataString += String(sensor);

  // The FileSystem card is mounted at the following "/mnt/FileSystema1"
  File dataFile = FileSystem.open("/mnt/sd/datalog.txt", FILE_APPEND);

  if (dataFile) {
    dataFile.println(dataString);
    dataFile.close();
    Serial.println(dataString);
  } else {
    Serial.println("error opening datalog.txt");
  }
  
  sprintf (buf, "%04i", sensor);
  myDisplay.scroll(buf, 0);

  delay(1000);

}

String getTimeStamp() {
  String result;
  Process time;
  time.begin("date");
  time.addParameter("+%F %T");
  time.run();

  while (time.available() > 0) {
    char c = time.read();
    if (c != '\n')
      result += c;
  }

  return result;
}


