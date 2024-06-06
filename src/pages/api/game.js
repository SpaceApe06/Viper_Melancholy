let totalClicks = 0;
let enemiesKilled = 0;
let lastSavedClicks = 0;
let lastSavedKills = 0;

// Fetch the previous total clicks from the database when the game starts
var xhr = new XMLHttpRequest();
xhr.open('GET', 'game.php', true);

xhr.onload = function() {
  if (this.status == 200) {
    totalClicks = parseInt(this.responseText); // Parse the response text as an integer
    lastSavedClicks = totalClicks; // Initialize lastSavedClicks with the previous total clicks
  }
};
xhr.send();

// Increase totalClicks every time the player clicks
function playerClick() {
  totalClicks++;
  document.getElementById('counter').innerText = 'Current clicks: ' + totalClicks;
}

// Increase enemiesKilled and save stats every time an enemy is killed
function enemyKilled() {
  enemiesKilled++;
  saveToStats(); // Save stats every time an enemy is killed
}


// Game logic
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

    // Reset the life of the enemies
    for (let i = 0; i < enemies.length; i++) {
      enemies[i].life = enemies[i].initialLife;
    }

    // Save stats when the loop is over
    saveToStats();
  }
}

// øker totalClicks hver gang spilleren klikker
function playerClick() {
  totalClicks++;
}

var extraClickAdded = false; // Initialize extraClickAdded as false

// lagrer totale klikk og fiender drept i databasen 
function saveToStats() {
  if (!extraClickAdded) {
    totalClicks++; // Add an extra click before saving
    extraClickAdded = true; // Set extraClickAdded to true
  }

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'game.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('click=' + totalClicks + '&kills=' + enemiesKilled);
}

// setInterval(saveToStats, 10000); // Save stats every minute