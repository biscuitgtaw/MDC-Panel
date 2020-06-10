<div class="container" data-aos="fade-in" data-aos-duration="500" data-aos-delay="250">
	<h1><i class="fas fa-fw fa-car mr-2"></i>Traffic Report</h1>
	<form action="/controllers/form-processor.php" method="POST">
		<input type="hidden" id="generatorType" name="generatorType" value="TrafficReport">
		<?php
			// Section - General
			$c->form('general', 'sections', array(
				'g' => $g,
				'c' => $c,
				'time' => true,
				'patrol' => false,
				'callsign' => true
			));
			// Section - Officers
			$c->form('officer', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'badge' => true,
				'slots' => true
			));
		?>
		<hr>
		<h4 class="mb-2"><i class="fas fa-fw fa-clipboard mr-2"></i>Defendant & Narrative</h4>
		<div class="form-row">
			<?php
				// Form - Textfield - Defedant's Name
				$c->form('textfield', 'forms', array(
					'size' => '4',
					'type' => 'text',
					'label' => '<label>Defendant&#39;s Full Name</label>',
					'icon' => 'id-card',
					'class' => '',
					'id' => 'inputDefName',
					'name' => 'inputDefName',
					'value' => '',
					'placeholder' => 'Firstname Lastname',
					'tooltip' => 'Defendant - Full Name',
					'attributes' => 'required',
					'style' => ''
				));
				// Form - List - Defendant License
				$c->form('list', 'forms', array(
					'size' => 'auto',
					'label' => '<label>Drivers License</label>',
					'icon' => 'id-card',
					'class' => 'selectpicker',
					'id' => 'inputDefLicense',
					'name' => 'inputDefLicense',
					'attributes' => 'required',
					'title' => 'Select License Status',
					'list' => $pg->listChooser('licensesList'),
					'hint' => '',
					'hintClass' => ''
				));
			?>
		</div>
		<div class="form-row">
			<?php
				// Form - Textbox - Narrative & Notes
				$c->form('textbox', 'forms', array(
					'size' => '6',
					'label' => '<label>Narrative & Notes</label>',
					'icon' => 'clipboard',
					'id' => 'inputNarrative',
					'name' => 'inputNarrative',
					'rows' => '4',
					'placeholder' => 'Witnessed the defendant to be...',
					'attributes' => 'required',
					'hint' => '<strong>Enter as much detail as possible in regards to the traffic stop, any particular events of interest which were witnessed, whether the defendant complied and was respectful.</strong>'
				));
				// Form - Textbox - Dashboard Camera
				$c->form('textbox', 'forms', array(
					'size' => '6',
					'label' => '<label>Dashboard Camera</label>',
					'icon' => 'video',
					'id' => 'inputDashcam',
					'name' => 'inputDashcam',
					'rows' => '4',
					'placeholder' => 'The dashboard camera captures audio and video footage showcasing the defendant to be...',
					'attributes' => '',
					'hint' => '<strong>(( Dashboard camera roleplay. - Do not include "/do" or " * ". - <strong style="color: darkred;">Lying in this section will lead to punishments</strong>. Enter as much detail as possible in regards to what the dashboard camera would capture on video and audio. ))</strong>'
				));
			?>
		</div>
		<?php
			// Section - Vehicle
			$c->form('vehicle', 'sections', array(
				'g' => $g,
				'pg' => $pg,
				'c' => $c,
				'tints' => true,
				'vehROTooltip' => 'Leave empty if the R.O is the defendant.',
				'vehROAttributes' => ''
			));
			// Section - Location
			require_once 'sections/location.php';
		?>
		<hr>
		<h4><i class="fas fa-fw fa-receipt mr-2"></i>Charges</h4>
		<div class="form-row groupSlotCitation crimeSelectorGroup">
		<?php
			// Form - List - Citation
			$c->form('list', 'forms', array(
				'size' => '6',
				'label' => '<label>Charge</label>',
				'icon' => 'gavel',
				'class' => 'selectpicker inputCrimeSelector',
				'id' => 'inputCrime-1',
				'name' => 'inputCrime[]',
				'attributes' => 'required data-live-search="true"',
				'title' => 'Select Charge',
				'list' => $pg->chargeChooser(),
				'hint' => '',
				'hintClass' => ''
			));
			// Form - List - Citation Class
			$c->form('list', 'forms', array(
				'size' => '2',
				'label' => '<label>Class</label>',
				'icon' => 'ellipsis-v',
				'class' => 'selectpicker inputCrimeClassSelector',
				'id' => 'inputCrimeClass-1',
				'name' => 'inputCrimeClass[]',
				'attributes' => 'required',
				'title' => 'Select Class',
				'list' => '',
				'hint' => '',
				'hintClass' => ''
			));
			// Form - Textfield - Citation Fine
			$c->form('textfield', 'forms', array(
				'size' => '2',
				'type' => 'number',
				'label' => '<label>Fine</label>',
				'icon' => 'dollar-sign',
				'class' => '',
				'id' => 'inputCrimeFine',
				'name' => 'inputCrimeFine[]',
				'value' => '',
				'placeholder' => '####',
				'tooltip' => 'Leave empty if no fine.',
				'attributes' => '',
				'style' => 'text-transform: uppercase;'
			));
			// Form - Options Add - Citation
			$c->form('options', 'forms', array(
				'size' => '2',
				'label' => '<label>Options</label>',
				'action' => 'addCitation',
				'colour' => 'success',
				'icon' => 'fa-plus-square',
				'text' => 'Citation'
			));
		?>
		</div>
		<?php
			// Form - Submit
			$c->form('submit', 'forms', array());
		?>
	</form>
	<?php
		// COPY SLOTS

		// OFFICER SLOT
		require_once 'copy-slots/officer.php';
	?>
	<div class="container copyGroupSlotCitation" style="display: none;">
	<?php
		// Form - List - Citation
		$c->form('list', 'forms', array(
			'size' => '6',
			'label' => '',
			'icon' => 'gavel',
			'class' => 'select-picker-copy inputCrimeSelector',
			'id' => 'inputCrime-',
			'name' => 'inputCrime[]',
			'attributes' => 'required data-live-search="true"',
			'title' => 'Select Charge',
			'list' => $pg->chargeChooser(),
			'hint' => '',
			'hintClass' => ''
		));
		// Form - List - Citation Class
		$c->form('list', 'forms', array(
			'size' => '2',
			'label' => '',
			'icon' => 'ellipsis-v',
			'class' => 'select-picker-copy inputCrimeClassSelector',
			'id' => 'inputCrimeClass-',
			'name' => 'inputCrimeClass[]',
			'attributes' => 'required',
			'title' => 'Select Class',
			'list' => '',
			'hint' => '',
			'hintClass' => ''
		));
		// Form - Textfield - Citation Fine
		$c->form('textfield', 'forms', array(
			'size' => '2',
			'type' => 'number',
			'label' => '',
			'icon' => 'dollar-sign',
			'class' => '',
			'id' => 'inputCrimeFine',
			'name' => 'inputCrimeFine[]',
			'value' => '',
			'placeholder' => '####',
			'tooltip' => 'Leave empty if no fine.',
			'attributes' => '',
			'style' => 'text-transform: uppercase;'
		));
		// Form - Options Remove - Citation
		$c->form('options', 'forms', array(
			'size' => '2',
			'label' => '',
			'action' => 'removeCitation',
			'colour' => 'danger',
			'icon' => 'fa-minus-square',
			'text' => 'Citation'
		));
	?>
	</div>
</div>

<?php require_once 'form-footer.php'; ?>