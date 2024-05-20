// Initialize game variables
let totalClicks = 0;
let enemiesKilled = 0;

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

function playerClick() {
  totalClicks++;
}

function clickEnemy() {
  count++;
  document.getElementById("counter").innerHTML = "Current Clicks: " + count;

  // Reduser fiendens liv med 10
  enemies[currentEnemyIndex].life -= 10;
  
  // hvis fienden er død så vil den gå til neste fiende
  if (enemies[currentEnemyIndex].life <= 0) {
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

    if (enemies[currentEnemyIndex].life <= 0) {
      enemiesKilled++;
      newEnemy();
    }

    // nullstiller livet til fiendene
    for (let i = 0; i < enemies.length; i++) {
      enemies[i].life = enemies[i].initialLife;
    }
  }
}

// Increase totalClicks every time the player clicks
function playerClick() {
  totalClicks++;
  // Other game logic...
}

// Increase enemiesKilled every time an enemy is killed
function enemyKilled() {
  enemiesKilled++;
  // Other game logic...
  // saveToStats();
}

// Save totalClicks and enemiesKilled to the database every minute
function saveToStats() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'game.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('click=' + totalClicks + '&kills=' + enemiesKilled);
}

setInterval(saveToStats, 10000);