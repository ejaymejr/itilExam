<table class="table bordered condensed">
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Question</label></td>
		<td class="">
		<input type="input" id="usedExamID" name="usedExamID" value="test">
		<?php 
			echo HTMLLib::wysiwygFormat($lastQuestion);
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Question</label></td>
		<td class=""><pre><?php 
			echo HTMLLib::CreateTextArea('question', $question, 'span12')
		?></pre></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Selection A</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateInputText('selection_a', $selection_a)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Selection B</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateInputText('selection_b', $selection_b)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Selection C</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateInputText('selection_c', $selection_c)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Selection D</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateInputText('selection_d', $selection_d)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Answer</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateTextArea('answer', $answer, 'span12')
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Reference</label></td>
		<td class=""><?php 
			echo HTMLLib::CreateInputText('reference', $reference)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label>Illustration</label></td>
		<td class=""><?php 
			//echo HTMLLib::CreateInputText('illustration', $illustration)
		?></td>
	</tr>
	<tr>
		<td class="bg-clearBlue text-right span2"><label></label></td>
		<td class=""><?php 
			echo HTMLLib::CreateSubmitButton('save', 'Save Question')
		?></td>
	</tr>
	<tr>
		<td></td>
	</tr>	
</table>