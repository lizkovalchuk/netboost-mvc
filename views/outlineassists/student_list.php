			<tr>
				<th>First</th>
				<th>Last</th>
				<th>Action</th>
			</tr>
<?php foreach ($this->selectedStudents as $student) {?>
			<tr>
				<td><?=$student->first_name?></td>
				<td><?=$student->last_name?></td>
				<td>
					<button id="btn-<?=$student->id?>" class="btn-link" onclick="deleteStudent(event)">Delete</button>
				</td>
			</tr>
<?php }?>