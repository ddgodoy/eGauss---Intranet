<table width="100%" cellpadding="0" cellspacing="0" style="padding-top:5px;">
	<tr>
		<td class="bscmp_tdb">
			<h1 class="titulos" style="border:none;">
				<?php echo $datos['prj_nombre'] ?>
				<span style="font-size:14px;">&nbsp;|&nbsp;<?php echo $datos['prj_descripcion'] ?></span>
			</h1>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td>
						<a href="<?php echo $datos['head_mensajes']['enlace'] ?>" target="_blank" class="bscmp_link2">
							<?php echo $datos['head_mensajes']['cantidad'] ?>&nbsp;Discussions
						</a>
					</td><td width="30">&nbsp;</td>
					<td>
						<a href="<?php echo $datos['head_todos']['enlace'] ?>" target="_blank" class="bscmp_link2">
							<?php echo $datos['head_todos']['cantidad'] ?>&nbsp;To-dos
						</a>
					</td><td width="30">&nbsp;</td>
					<td>
						<a href="<?php echo $datos['head_archivos']['enlace'] ?>" target="_blank" class="bscmp_link2">
							<?php echo $datos['head_archivos']['cantidad'] ?>&nbsp;Files
						</a>
					</td><td width="30">&nbsp;</td>
					<td>
						<a href="<?php echo $datos['head_documentos']['enlace'] ?>" target="_blank" class="bscmp_link2">
							<?php echo $datos['head_documentos']['cantidad'] ?>&nbsp;Documents
						</a>
					</td><td width="30">&nbsp;</td>
					<td>
						<a href="<?php echo $datos['head_eventos']['enlace'] ?>" target="_blank" class="bscmp_link2">Events</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td colspan="5"><a href="<?php echo $datos['link_eventos'] ?>" target="_blank" class="bscmp_link3">Latest project updates</a></td>
				</tr>
				<tr><td height="5"></td></tr>
				<?php if (count($datos['last_updates']) > 0): ?>
					<?php foreach ($datos['last_updates'] as $l_update): ?>
					<tr>
						<td class="bscmp_tnml"><strong><?php echo $l_update['hora'] ?></strong></td><td width="20"></td>
						<td class="bscmp_tnml"><?php echo $l_update['autor'] ?></td>
						<td class="bscmp_tnml">&nbsp;<em><?php echo $l_update['action'] ?></em>&nbsp;</td>
						<td>
							<a href="<?php echo $l_update['enlace'] ?>" target="_blank" class="bscmp_link4"><?php echo $l_update['target'] ?></a>
						</td>
					</tr>
					<tr><td height="3"></td></tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5"><a href="<?php echo $datos['link_eventos'] ?>" target="_blank" class="bscmp_link4">See all updates</a></td>
					</tr>
				<?php else: ?>
					<tr><td class="bscmp_tnml"><em>-- No info --</em></td></tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td colspan="5"><a href="<?php echo $datos['head_mensajes']['enlace'] ?>" target="_blank" class="bscmp_link3">Discussions</a></td>
				</tr>
				<tr><td height="5"></td></tr>
				<?php if (count($datos['last_topics']) > 0): ?>
					<?php foreach ($datos['last_topics'] as $l_topics): ?>
					<tr>
						<td class="bscmp_tnml"><?php echo $l_topics['autor'] ?></td><td width="20"></td>
						<td class="bscmp_tnml">
							<a href="<?php echo $l_topics['enlace'] ?>" target="_blank" class="bscmp_link4"><?php echo $l_topics['title'] ?></a>
						</td><td width="20"></td>
						<td class="bscmp_tnml"><?php echo $l_topics['fecha'] ?></td>
					</tr>
					<tr><td height="3"></td></tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="5"><a href="<?php echo $datos['head_mensajes']['enlace'] ?>" target="_blank" class="bscmp_link4">See all discussions</a></td>
					</tr>
				<?php else: ?>
					<tr><td class="bscmp_tnml"><em>-- No info --</em></td></tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td colspan="5"><a href="<?php echo $datos['head_todos']['enlace'] ?>" target="_blank" class="bscmp_link3">To-do lists</a></td>
				</tr>
				<?php if (count($datos['lista_todo']) > 0): ?>
					<?php foreach ($datos['lista_todo'] as $l_todos): ?>
						<tr><td height="5"></td></tr>
						<tr>
							<td colspan="4">
								<a href="<?php echo $l_todos['enlace'] ?>" target="_blank" class="bscmp_link2"><?php echo $l_todos['nombre'] ?></a>
							</td>
						</tr>
						<tr><td height="3"></td></tr>
						<?php foreach ($l_todos['todos'] as $l_todo): ?>
						<tr>
							<td>
								<a href="<?php echo $l_todo['enlace'] ?>" target="_blank" class="bscmp_link4">
									<?php echo $l_todo['nombre'] ?>
								</a>
							</td>
							<td class="bscmp_tnml">&nbsp;|&nbsp;<?php echo $l_todo['cant_c'] ?>&nbsp;comments&nbsp;|&nbsp;</td>
							<td class="bscmp_tnml"><?php echo $l_todo['asigne'] ?></td>
							<td class="bscmp_tnml">&nbsp;|&nbsp;<strong><?php echo $l_todo['fecha'] ?></strong></td>
						</tr>
						<tr><td height="2"></td></tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				<?php else: ?>
					<tr><td height="5"></td></tr>
					<tr><td class="bscmp_tnml"><em>-- No info --</em></td></tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td colspan="4"><a href="<?php echo $datos['head_archivos']['enlace'] ?>" target="_blank" class="bscmp_link3">Files</a></td>
				</tr>
				<tr><td height="5"></td></tr>
				<?php if (count($datos['last_files']) > 0): ?>
					<?php foreach ($datos['last_files'] as $l_files): ?>
					<tr>
						<td class="bscmp_tnml"><strong><?php echo $l_files['fecha'] ?></strong></td><td width="20"></td>
						<td class="bscmp_tnml">
							<a href="<?php echo $l_files['enlace'] ?>" target="_blank" class="bscmp_link4">
								<?php echo $l_files['name'] ?>
							</a>
						</td>
						<td class="bscmp_tnml">&nbsp;<em>Added by</em>&nbsp;<?php echo $l_files['autor'] ?></td>
					</tr>
					<tr><td height="3"></td></tr>
					<?php endforeach; ?>
					<tr>
						<td colspan="4"><a href="<?php echo $datos['head_archivos']['enlace'] ?>" target="_blank" class="bscmp_link4">See all files</a></td>
					</tr>
				<?php else: ?>
					<tr><td class="bscmp_tnml"><em>-- No info --</em></td></tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td class="bscmp_tdb">
			<table>
				<tr>
					<td colspan="3"><a href="<?php echo $datos['head_documentos']['enlace'] ?>" target="_blank" class="bscmp_link3">Documents</a></td>
				</tr>
				<tr><td height="5"></td></tr>
				<?php if (count($datos['last_documents']) > 0): ?>
					<?php foreach ($datos['last_documents'] as $l_docs): ?>
					<tr>
						<td class="bscmp_tnml">
							<a href="<?php echo $l_docs['enlace'] ?>" target="_blank" class="bscmp_link4">
								<?php echo $l_docs['name'] ?>
							</a>
						</td><td width="20"></td>
						<td class="bscmp_tnml">&nbsp;|&nbsp;<?php echo $l_docs['fecha'] ?></td>
					</tr>
					<tr><td height="3"></td></tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr><td class="bscmp_tnml"><em>-- No info --</em></td></tr>
				<?php endif; ?>
			</table>
		</td>
	</tr>
</table>