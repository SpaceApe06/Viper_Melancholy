let count = 0;
let enemies = [
  { name: "Enemy 1", image: "/public/enemy/enemy1.png", life: 100, initialLife: 100 },
  { name: "Enemy 2", image: "/public/enemy/enemy2.png", life: 200, initialLife: 200 },
  { name: "Enemy 3", image: "/public/enemy/enemy3.png", life: 300, initialLife: 300 },
];
let currentEnemyIndex = 0;

function clickEnemy() {
  count++;
  document.getElementById("counter").innerHTML = "Total Clicks: " + count;

  // Decrease current enemy's life
  enemies[currentEnemyIndex].life -= 10;
  
  // If current enemy's life is 0 or less, move to next enemy
  if (enemies[currentEnemyIndex].life <= 0) {
    newEnemy();
  }
  
  // Update enemy image, name, and life display
  document.getElementById("enemyImage").src = enemies[currentEnemyIndex].image;
  document.getElementById("enemyName").innerHTML = enemies[currentEnemyIndex].name;
  document.getElementById("hp").innerHTML = "HP: " + enemies[currentEnemyIndex].life;
}

function newEnemy() {
  currentEnemyIndex++;
  if (currentEnemyIndex >= enemies.length) {
    currentEnemyIndex = 0; // Loop back to first enemy if we've gone through all enemies

    // Reset all enemies' health
    for (let i = 0; i < enemies.length; i++) {
      enemies[i].life = enemies[i].initialLife;
    }
  }
}