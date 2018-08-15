<?php
	# Tänker mig att detta kommer från ACF?
	$data = [
		'packages' => [
			[
				'title' => 'Small',
				'price_per_month' => 249,
				'price_first_months' => 99,
				'num_months_low_price' => 3
			],
			[
				'title' => 'Medium',
				'price_per_month' => 299,
				'price_first_months' => 99,
				'num_months_low_price' => 3
			],
			[
				'title' => 'Large',
				'price_per_month' => 349,
				'price_first_months' => 99,
				'num_months_low_price' => 3
			]
		],
		'phones' => [
			'iPhone', 'Samsung Galaxy', 'Nexus 6P'
		]
	];

	# Men sen behövs lite mer
	foreach ($data['packages'] as $k => $v) {
		$data['packages'][$k]['num_selected'] = 0; # Antal valda abonnemang

		# De här behövs också sen när man valt ett paket
		$data['packages'][$k]['old_number'] = null;
		$data['packages'][$k]['new_number'] = false;
		$data['packages'][$k]['add_phone'] = false;
		$data['packages'][$k]['new_phone'] = null;
		$data['packages'][$k]['twin_card'] = false;
	}
?>

<style>
	/* FULHACK! :P */
	#order-form article .content {
		display: none;
	}

	#order-form article.active .content {
		display: block;
	}

	.list--comma > *:after {
		content: ", ";
	}
	.list--comma > :last-child:after {
		content: "";
	}
</style>

<section id="order-form" class="section">

	<!-- Step 1 -->
	<article v-bind:class="{active: step == 1}" v-show="!done">

		<h2><a v-on:click="goto(1)">Antal abonnemang</a></h2>

		<form v-on:submit.prevent="addPackages" class="content">

			<ul class="list--plain">
				<li v-for="package in data.packages">
					<h3>{{ package.title }} ({{ package.price_per_month }}kr/mån)</h3>
					<p>{{ package.price_first_months }}kr/mån i {{ package.num_months_low_price }} mån</p>
					<p>
						<a v-on:click="package.num_selected--">-</a>
						<input type="number" v-model="package.num_selected">
						<a v-on:click="package.num_selected++">+</a>
					</p>
				</li>
			</ul>

			<button>Nästa</button>

		</form>

	</article>

	<!-- Step 2 -->
	<article v-bind:class="{active: step == 2}" v-show="!done">

		<h2><a v-on:click="goto(2)">Behålla eller nytt nummer</a></h2>

		<form v-on:submit.prevent="goto(3)" class="content">

			<ul class="list--plain">
				<li v-for="(package, index) in selectedPackages">
					<h3>Abonnemang {{ index + 1 }} - {{ package.title }}</h3>
					<p><input type="tel" v-model="package.old_number" v-show="package.new_number == false" placeholder="Nummer att flytta till FreedomFighters"></p>
					<p>
						<label>
							<input type="checkbox" v-model="package.new_number">
							Jag vill ha nytt nummer
						</label>
					</p>
					<p>
						<label>
							<input type="checkbox" v-model="package.twin_card">
							Lägg till tvillingkort (+99kr)
						</label>
					</p>
					<p>
						<label>
							<input type="checkbox" v-model="package.add_phone">
							Jag vill lägga till en mobil
						</label>
					</p>
					<p>
						<select v-model="package.new_phone" v-show="package.add_phone == true">
							<option disabled value="">Välj mobil här...</option>
							<option v-for="phone in data.phones">{{ phone }}</option>
						</select>
					</p>
				</li>
			</ul>

			<button>Nästa</button>

		</form>

	</article>

	<!-- Step 3  -->
	<article v-bind:class="{active: step == 3}" v-show="!done">

		<h2><a v-on:click="goto(3)">Företagsuppgifter</a></h2>

		<form v-on:submit.prevent="goto(4)" class="content">

			<p><input type="text" v-model="company.org" placeholder="Organisationsnummer" required></p>

			<p><input type="text" v-model="company.name" placeholder="Namn" required></p>

			<p><input type="email" v-model="company.email" placeholder="E-post" required></p>

			<p><input type="text" v-model="company.address" placeholder="Adress" required></p>

			<p><input type="text" v-model="company.city" placeholder="Ort" required></p>

			<p><input type="text" v-model="company.postal" placeholder="Postnummer" required></p>

			<button>Nästa</button>

		</form>

	</article>

	<!-- Step 4 -->
	<article v-bind:class="{active: step == 4}" v-show="!done">

		<h2><a v-on:click="goto(4)">Beställ</a></h2>

		<div class="content">

			<h3>Kontrollera att nedan stämmer:</h3>

			<ul class="list--plain">
				<li v-for="package of selectedPackages">
					<h4>Abbonemang {{ package.title }}</h4>
					<p>Pris: {{ package.price_per_month }}kr/mån <small>({{ package.price_first_months }}kr/mån i {{ package.num_months_low_price }} mån)</small></p>
					<p class="list--comma">
						<span v-show="!package.new_number && package.old_number">Befintligt nummer {{ package.old_number }}</span>
						<span v-show="package.new_number">Nytt nummer</span>
						<span v-show="package.add_phone && package.new_phone">Ny telefon ({{ package.new_phone }})</span>
						<span v-show="package.twin_card">Tvillingkort</span>
					</p>
				</li>
			</ul>

			<h3>Företagsuppgifter</h3>

			<p>Organisationsnummer: {{ company.org }}</p>
			<p>Ditt namn: {{ company.name }}</p>
			<p>E-post: {{ company.email }}</p>
			<p>Adress: {{ company.address }}, {{ company.postal }}, {{ company.city }}</p>

			<h3>Din beställning är snart klar</h3>

			<p>Lorem ipsum dolor</p>

			<button v-on:click="submit">Beställ</button>

		</div>

	</article>

	<!-- DONE! -->
	<article v-show="done">

		<h2>TACK!</h2>

	</article>

</section>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
	var orderForm = new Vue({
		el: '#order-form',
		methods: {
			// Loopa igenom alla valda paket och skapa en ny array med selectedPackages
			addPackages: function () {
				var selected = [];

				this.data.packages.forEach(function (p) {
					for (var i = 0; i < p.num_selected; i++) {
						selected.push(Object.assign({}, p));
					}
				});

				this.selectedPackages = selected;
				this.step = 2;
			},

			// Goto ett step
			goto: function (step) {
				this.step = step;
			},

			// Skicka beställningen
			submit: function () {
				console.dir(this.selectedPackages);
				console.dir(this.company);
				this.done = true;

				// Du får väl sätta upp en endpoint för detta I guess?
			/*	$.post('/wp-admin/admin-ajax.php?action=send_order', {
					company: this.company,
					selectedPackages: this.selectedPackages
				}, function (data) {
					this.done = true;
				}); */
			},

			increaseNumSelected: function (p) {
				p.num_selected++;
			},

			decreaseNumSelected: function (p) {
				if (p.num_selected > 0) {
					p.num_selected--;
				}
			}
		},
		data: {
			data: <?php echo json_encode($data) ?>,
			selectedPackages: [],
			company: {
				org: null,
				name: null,
				email: null,
				address: null,
				city: null,
				postal: null
			},
			step: 1,
			done: false
		}
	});
</script>
