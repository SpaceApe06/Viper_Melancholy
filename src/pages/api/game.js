let totalClicks = 0;
let enemiesKilled = 0;
let lastSavedClicks = 0;
let lastSavedKills = 0;

// henter det forrige totale klikk når spillet starter
var xhr = new XMLHttpRequest();
xhr.open('GET', 'game.php', true);

xhr.onload = function() {
  if (this.status == 200) {
    totalClicks = parseInt(this.responseText); // parse gjør at string blir til en integer
    lastSavedClicks = totalClicks; // gjør at lastSavedClicks er lik totalClicks
  }
};
xhr.send();

// totaltclicks vil bli økt for hver gang spilleren klikker
function playerClick() {
  totalClicks++;
  document.getElementById('counter').innerText = 'Current clicks: ' + totalClicks;
}

// øker enemiesKilled hver gang en fiende blir drept og lagrer det
function enemyKilled() {
  enemiesKilled++;
  saveToStats();
}

// spill logikken
let count = 0;

// array liste med alle fiendene med navn, bilde og liv
let enemies = [
  { name: "Enemy 1", image: "/public/enemy/enemy1.png", life: 100, initialLife: 100 },
  { name: "Enemy 2", image: "/public/enemy/enemy2.png", life: 200, initialLife: 200 },
  { name: "Enemy 3", image: "/public/enemy/enemy3.png", life: 300, initialLife: 300 },
];
let currentEnemyIndex = 0;

document.getElementById("enemyImage").addEventListener("click", function() {
  clickEnemy();
  playerClick();
});

function clickEnemy() {
  count++;
  document.getElementById("counter").innerHTML = "Current Clicks: " + count;

  // Reduser fiendens liv med 10
  enemies[currentEnemyIndex].life -= 10;
  
  // hvis fienden er død så vil den gå til neste fiende
  if (enemies[currentEnemyIndex].life <= 0) {
    enemiesKilled++;
    newEnemy();
  }
  
  // oppdater bilde, navn og hp til den nåværende fienden
  document.getElementById("enemyImage").src = enemies[currentEnemyIndex].image;
  document.getElementById("enemyName").innerHTML = enemies[currentEnemyIndex].name;
  document.getElementById("hp").innerHTML = "HP: " + enemies[currentEnemyIndex].life;
}

// bytt til neste fiende og hvis den har gått gjennom alle fiendene så vil den starte på nytt fra første fiende
function newEnemy() {
  currentEnemyIndex++;
  if (currentEnemyIndex >= enemies.length) {
    currentEnemyIndex = 0;

    // resets fienedenes liv
    for (let i = 0; i < enemies.length; i++) {
      enemies[i].life = enemies[i].initialLife;
    }

    // når loopen er ferdig så vil den lagre fiender drept
    saveToStats();
  }
}

// øker totalClicks hver gang spilleren klikker
function playerClick() {
  totalClicks++;
}
//setter et ekstra clicks til false, dette eksister pga en bug som gjør at det er en klikk for lite 
//og jeg bare la til en ekstra klikk for å fikse det
var extraClickAdded = false; 

// lagrer totale klikk og fiender drept i databasen 
function saveToStats() {
  if (!extraClickAdded) {
    totalClicks++; // Add an extra click before saving
    extraClickAdded = true; // Set extraClickAdded to true
  }

  // sender en post request til game.php med totalClicks og enemiesKilled
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'game.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('click=' + totalClicks + '&kills=' + enemiesKilled);
}

// setInterval(saveToStats, 10000); // Save stats every minute