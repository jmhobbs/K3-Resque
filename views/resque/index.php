
<h1 class='wi'>Queues</h1> 
<p class='intro'>The list below contains all the registered queues with the number of jobs currently in the queue. Select a queue from above to view all jobs currently pending on the queue.</p> 
<table class='queues'> 
	<tr> 
		<th>Name</th> 
		<th>Jobs</th> 
	</tr> 
	<?php foreach( $queues as $name => $info ): ?>
	<tr> 
		<td class='queue'><a class="queue" href="/resque/queues/<?php echo html::chars( $name ); ?>"><?php echo html::chars( $name ); ?></a></td> 
		<td class='size'><?php echo html::chars( $info['size'] ); ?></td> 
	</tr>
	<?php endforeach; ?>
	<tr class="failed"> 
		<td class="queue failed"><a class="queue" href="/resque/failed">failed</a></td> 
		<td class="size"><?php echo html::chars( $failed ); ?></td> 
	</tr>
</table> 
 
<hr />

<h1 class='wi'>0 of 0 Workers Working</h1> 
<p class='intro'>The list below contains all workers which are currently running a job.</p> 
<table class='workers'> 
	<tr> 
		<th>&nbsp;</th> 
		<th>Where</th> 
		<th>Queue</th> 
		<th>Processing</th> 
	</tr>
	<?php if( 0 == count( $workers ) ): ?>
	<tr> 
		<td colspan="4" class='no-data'>Nothing is happening right now...</td> 
	</tr>
	<?php else: ?>
	<?php foreach( $workers as $worker => $info ): ?>
	<tr>
		<td></td>
		<td><?php echo html::chars( $worker ); ?></td>
		<td></td>
		<td><?php echo ( ( $info['working'] ) ? 'Yes' : 'No' ); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
</table>
