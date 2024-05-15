// ---
// interface Props {
// 	name: string;
// 	hp: string;
// 	id: string;
// }

// const { name, hp, id } = Astro.props;
// ---

// <div id="enemy">
// 	<p id="total_hp">hp:</p>
// 	<p id="hp">{hp}</p>
// 	<p id="name">{name}</p>
// 	<img id="image" draggable="false" />
// </div>

// <style>
// 	* {
// 		user-select: none;
// 	}

// 	#image:hover {
// 		cursor: pointer;
// 	}
// </style>
	// var image = document.getElementById("image") as HTMLImageElement;
	var name = document.getElementById("name").innerHTML;
	var hp = document.getElementById("hp");
	let antall = 1;
	image.src = `enemy/test1.png`;

	image.addEventListener("click", click);

	var enemies = {
		test: { hp: "10" },
		test2: { hp: "20" },
		test3: { hp: "30"}
	};

	function newEnemy() {
		hp.innerHTML = "10";
	}
	function click() {
		var counter = document.getElementById("counter");
		var count = parseInt(counter.innerHTML);
		count += 1;
		counter.innerHTML = count.toString();

		var dmg = parseInt(hp.innerHTML);
		dmg -= 1;
		hp.innerHTML = dmg.toString();
		if (dmg <= 0) {
			newEnemy();
		}
	}
