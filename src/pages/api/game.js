let count = 0;

// array liste med alle fiendene med navn, bilde og liv
let enemies = [
  { name: "Enemy 1", image: "/public/enemy/enemy1.png", life: 100, initialLife: 100 },
  { name: "Enemy 2", image: "/public/enemy/enemy2.png", life: 200, initialLife: 200 },
  { name: "Enemy 3", image: "/public/enemy/enemy3.png", life: 300, initialLife: 300 },
];
let currentEnemyIndex = 0;

function clickEnemy() {
  count++;
  document.getElementById("counter").innerHTML = "Total Clicks: " + count;

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

    // nullstiller livet til fiendene
    for (let i = 0; i < enemies.length; i++) {
      enemies[i].life = enemies[i].initialLife;
    }
  }
}