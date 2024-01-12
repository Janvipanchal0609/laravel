<?php
echo "<h1>Hi hello</h1>";
?>

<h1>{{"hi hello"}}</h1>  

<?php /* i am comment */ ?>
{{-- i am comment --}}


<h1>{{10+10}}</h1>
<h1><?php echo 10+10; ?></h1>

<?php
$name="Rajesh";
?>
@if($name=="Janvi")
<h1>Hi my name is {{$name}}</h1>
@elseif($name=="falguni")
<h1>Hi my name is {{$name}}</h1>
@else
<h1>Unknown</h1>	
@endif


<?php?>

@for($i=0;$i<=10;$i++)
<h1>{{$i}}</h1>
@endfor


<?php $users=['sam','Janvi','falguni'];?>
@if(!empty($users))
    @foreach($users as $d)
    <h4>{{$d}}</h4>
    @endforeach
@endif    
