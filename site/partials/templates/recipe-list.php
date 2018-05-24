<?php require('partials/traitements/recipe-list.php'); ?>

<?php foreach ($recipes as $key => $value) : ?>
	<article id="recette<?php echo $key ?>">
		<h2>
			<?php echo $value['nom'] ?>
		</h2>

		<p>
			<?php echo $value['description'] ?>
		</p>

		<div>
			<span>
				Durée totale&nbsp;: <?php echo $value['duree'] ?>
			</span>
			<span>
				Difficulté&nbsp;: <?php echo $difficulte[$value['difficulte']] ?>
			</span>
			<span>
				Prix&nbsp;: <?php echo $prix[$value['prix']] ?>
			</span>
			<span>
				<?php echo $type[$value['type']] ?>
			</span>
		</div>

		<div>
			Recette "<?php echo $note[$value['note']] ?>" ajoutée par <?php echo $value['auteur'] ?> le <?php echo date('d/m/Y', strtotime($value['ajout'])) ?>
		</div>
		
		<ul class="ingredients">
			<?php foreach ($value['ingredients'] as $value2) : ?>
				<li>
					<?php echo $value2['nom'] ?>
					<span>
						<?php
							if ($value2['quantite'] != 0) {
								$laQuantite = round($value2['quantite']/100);
								if ($laQuantite == 0) {
									$laQuantite = 1;
								}
							}
						?>
						<?php echo isset($laQuantite) ? $laQuantite : '' ?>
						<?php
							if ($value2['nomBase'] != 'Sans' && $value2['nomBase'] != 'Unité' ) {
								$lUnite = $value2['nomBase'];
							}
						?>
						<?php echo isset($lUnite) ? $lUnite : '' ?>
					</span>
				</li>
			<?php endforeach ?>
		</ul>

		<ol class="recette">
			<?php foreach ($value['etapes'] as $value1) : ?>
				<li>
					<?php echo $value1 ?>
				</li>
			<?php endforeach ?>
		</ol>
	</article>
<?php endforeach ?>