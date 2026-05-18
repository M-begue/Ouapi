<!-- BEGIN backup_message -->
	<div class="<!-- IF backup_message.TYPE eq 'success' -->backup_success<!-- ELSE -->backup_error<!-- ENDIF -->">
		<h3>{backup_message.TITLE}</h3>
		<p>{backup_message.TEXT}</p>
	</div>
	<br/>
<!-- END backup_message -->

<!-- BEGIN backup_interface -->
	<h2>{backup_interface.TITLE}</h2>
	<br/>
	
	<!-- Section: Créer une nouvelle sauvegarde -->
	<div class="backup_create_section">
		<h3>{backup_interface.CREATE_BACKUP}</h3>
		<p>Créez une sauvegarde complète de OUAPI (fichiers + base de données)</p>
		<br/>
		<form method="POST" action="">
			<input type="hidden" name="action" value="create_backup" />
			<input type="submit" class="button" value="{backup_interface.BUTTON_CREATE}" />
		</form>
	</div>
	
	<hr style="margin: 30px 0;"/>
	
	<!-- Section: Sauvegardes existantes -->
	<div class="backup_list_section">
		<h3>{backup_interface.LIST_TITLE}</h3>
		<br/>
		
		<!-- BEGIN backups -->
			<table class="backup_table" style="width:100%; border-collapse: collapse; margin-bottom: 20px;">
				<tr class="backup_row_header" style="background-color: #f0f0f0; border-bottom: 2px solid #ccc;">
					<th style="padding: 10px; text-align: left;">Sauvegarde</th>
					<th style="padding: 10px; text-align: left;">Date</th>
					<th style="padding: 10px; text-align: left;">Taille</th>
					<th style="padding: 10px; text-align: center;">Actions</th>
				</tr>
				<tr class="backup_row" style="border-bottom: 1px solid #eee;">
					<td style="padding: 10px;">{backup_interface.backups.NAME}</td>
					<td style="padding: 10px;">{backup_interface.backups.DATE}</td>
					<td style="padding: 10px;">{backup_interface.backups.SIZE}</td>
					<td style="padding: 10px; text-align: center;">
						<a href="process_backup.php?action=download&file={backup_interface.backups.NAME}" class="button_link" title="Télécharger">
							{backup_interface.backups.DOWNLOAD}
						</a>
						&nbsp;
						<a href="process_backup.php?action=delete&file={backup_interface.backups.NAME}" class="button_link_delete" title="Supprimer" onclick="return confirm('{backup_interface.backups.CONFIRM_DELETE}');">
							{backup_interface.backups.DELETE}
						</a>
					</td>
				</tr>
			</table>
		<!-- END backups -->
		
		<!-- IF NOT backups -->
			<p class="no_backup">{backup_interface.NO_BACKUP}</p>
		<!-- ENDIF -->
	</div>
	
	<style type="text/css">
		.backup_success {
			background-color: #d4edda;
			border: 1px solid #c3e6cb;
			color: #155724;
			padding: 12px;
			border-radius: 4px;
			margin-bottom: 20px;
		}
		
		.backup_error {
			background-color: #f8d7da;
			border: 1px solid #f5c6cb;
			color: #721c24;
			padding: 12px;
			border-radius: 4px;
			margin-bottom: 20px;
		}
		
		.backup_create_section {
			background-color: #f9f9f9;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		
		.backup_list_section {
			background-color: #f9f9f9;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 4px;
		}
		
		.backup_table {
			width: 100%;
		}
		
		.button_link, .button_link_delete {
			padding: 5px 10px;
			margin: 0 5px;
			text-decoration: none;
			border-radius: 3px;
			display: inline-block;
			font-size: 12px;
		}
		
		.button_link {
			background-color: #007bff;
			color: white;
		}
		
		.button_link:hover {
			background-color: #0056b3;
		}
		
		.button_link_delete {
			background-color: #dc3545;
			color: white;
		}
		
		.button_link_delete:hover {
			background-color: #c82333;
		}
		
		.no_backup {
			color: #666;
			font-style: italic;
		}
	</style>
	
<!-- END backup_interface -->
