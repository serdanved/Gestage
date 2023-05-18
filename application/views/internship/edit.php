<div class="row">
	<div class="col-md-12">
		<div class="box box-info" style="margin-top:50px;">
			<div class="box-header">
				<h3 class="box-title">
                    Stage de <?= $internship['STUDENT_NAME']; ?> chez <?= $internship['EMPLOYER_NAME']; ?>
                </h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<a name="informations"></a>
						<?php include("edit_informations.php"); ?>

						<a name="blocs"></a>
						<?php include("edit_blocs.php"); ?>

						<?php if (!is_student()): ?>
							<a id="presences" name="presences"></a>
							<?php include("edit_presences.php");
						endif; ?>

						<?php if (!is_student()): ?>
							<a id="horairestage" name="horairestage"></a>
							<?php include("edit_horaire_stage.php");
						endif; ?>

						<a id="vosobligations" name="vosobligations"></a>
						<?php include("edit_obligations.php"); ?>

						<a name="obligationsgenerales"></a>
						<?php if (!is_student() && !is_employer()):
							include("edit_obligations_generales.php");
						endif; ?>

						<a name="documents"></a>
						<?php include("edit_documents.php"); ?>

						<a name="notes"></a>
						<?php include("edit_notes.php"); ?>
						<?php if (!is_student() && !is_employer()) {
							//include("edit_notes_privees.php");
						} ?>

                        <a name="pdf"></a>
                        <?php include("edit_pdf.php"); ?>

						<!-- <a id="vosmessages" name="messagerie"></a> -->
						<?php //include("edit_messagerie.php");?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include("edit_modals.php"); ?>
