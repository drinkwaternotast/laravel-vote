<template>
	<div class="photo__row">
		<div class="about">
			<input type="radio" name="tabs" id="tab-nav-1" checked>
				<label for="tab-nav-1">
					Introduction
				</label>
			<input type="radio" name="tabs" id="tab-nav-2">
				<label for="tab-nav-2">
					Battle
				</label>
			<input type="radio" name="tabs" id="tab-nav-3">
				<label for="tab-nav-3">
					Vote							
				</label>
			<div class="tabs">
				<div>
					<h2>What is Cosplayer's Poll?</h2>
					<p class="tabs__en">This site is voting site for Cosplayers.<br>Let's make your photos fight with the photos of your favorite Cosplayer.</p>
					<p class="tabs__jp">このサイトはコスプレーヤーのための投票サイトになります。<br>人気のコスプレーヤーの写真と自分の最高の一枚を人気投票してみましょう。</p>
					<h2>The purpose of this service</h2>
					<p class="tabs__en">This site is opened for the purpose of helping Cosplayers become famous.<br>We hope that many supporters will contact you.</p>
					<p class="tabs__jp">このサイトを利用して、ぜひあなたのコスプレーヤーとしての知名度を上げてください。<br>多くの支援者があなたを応援してくれることを願っています。</p>
					<h2>How to</h2>
					<p class="tabs__en">How to use is very simple. Just upload your photo and choose the photo of the person you want to fight.<br>Photos that got many votes are displayed in the rankings and may decorate the top of this site.</p>
					<p class="tabs__jp">使い方はとてもシンプルです。自分の画像をアップロードし、対戦したい相手の写真を選ぶだけです。<br>多くの票を得た写真はランキングに表示され、サイトのTOPを飾るかもしれません。</p>
				</div>
				<div>
					<h2>Step 1.&nbsp;&nbsp;&nbsp;&nbsp;Upload your photo</h2>
					<i class="fa fa-cloud-upload fa-4x fa-fw"></i>
						<p>All uploaded images can be viewed for every users, and used for battle.<router-link :to="{name: 'uploadPhoto'}"><i class="fa fa-external-link fa-fw"></i></router-link></p>
					<h2>Step 2.&nbsp;&nbsp;&nbsp;&nbsp;Select your photo and the opponent's photo</h2>
					<i class="fa fa-search-minus fa-4x fa-fw"></i>
						<p>Press the "ENTRY" button under the picture you like.</p>
					<h2>Step 3.&nbsp;&nbsp;&nbsp;&nbsp;Start accepting votes</h2>
					<i class="fa fa-balance-scale fa-4x fa-fw"></i>
						<p>Just set two photos and press the "Start" button in the popup window.</p>
				</div>
				<div><h2>Step 1.&nbsp;&nbsp;&nbsp;&nbsp;Press the "Good" button.</h2>
					<i class="fa fa-thumbs-o-up fa-4x fa-fw"></i>
						<p>Press the "Good" button to the picture you thought good.<router-link :to="{name: 'currentBattles'}"><i class="fa fa-external-link fa-fw"></i></router-link></p>
				</div>
			</div>
		</div>
	</div>
</template>