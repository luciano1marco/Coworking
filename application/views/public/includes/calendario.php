<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<meta charset='utf-8' />
<link href='../lib/main.css' rel='stylesheet' />
<script src='../lib/main.js'></script>


<script>
	function dataAtualFormatada(){
		var data = new Date(),
			dia  = data.getDate().toString(),
			diaF = (dia.length == 1) ? '0'+dia : dia,
			mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
			mesF = (mes.length == 1) ? '0'+mes : mes,
			anoF = data.getFullYear();
		return anoF+"-"+mesF+"-"+diaF;
	}
	var data1 = dataAtualFormatada();
	//console.log(data1 );

		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');
			var calendar = new FullCalendar.Calendar(calendarEl, {
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: ''
				//--para mostras dia,mes,semana coloque isto nas aspas acima
				//  dayGridMonth,timeGridWeek,timeGridDay
			},
			//data1 é a data atual formatada no padrão 'ano - mes - dia'
			initialDate: data1,
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectMirror: true,
			select: function(arg) {
				calendar.unselect()
			},
			
			// -- remove evento
			eventClick: function(arg) {
				if (confirm('Tem certeza que deseja apagar o Evento?')) {
				arg.event.remove(),
				
			// ---para pegar o valor da hora marcada	
				nome = arg.event._def.title,
				result = nome.split(" "),
				x = result.length - 1,
				hora = result[x],
			//--para pegar a data:
				data1 = arg.event._instance.range.start,	
				dt = data1.toLocaleDateString(),
				dta = dt.split("/"),
				dtf = [dta[2],dta[1],dta[0]], 
				dt0 = parseInt(dtf[2]),
				dt0 = dt0 + 1,
				dtf[2] = dt0.toString(),
				dtfim =dtf.join("-"),
			//mostra no console
			//	console.log(dtfim),
			//	console.log(hora)
			
				window.location.href =  ($("#base_url").val() + "admin/" + $("#controlador").val() + "/deleteyes/" + dtfim + "/" + hora );
				
				}
			},
			
			
			editable: true,
			dayMaxEvents: true, // allow "more" link when too many events
			events: [
				//fazer um for para buscar do banco e mostrar na tela
				<?php foreach ($agenda as $ag) : ?>
					{
					title: '<?php echo $ag['nome'].' - '.$ag['deschora'].' - '.$ag['descmesa']; ?>',
					start: '<?php echo $ag['dia']; ?>',
				
					},

				<?php endforeach; ?>	
			]
			});

			calendar.render();
		});


</script>

<style>
	body {
		margin: 40px 10px;
		padding: 0;
		font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
		font-size: 14px;
	}
	#calendar {
		max-width: 1100px;
		margin: 0 auto;
	}
</style>

<div class="content-wrapper">
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				
						
							
                            
							<tbody>
								<div id='script-warning'>
									<!--	<code>php/get-events.php</code> must be running.-->
								</div>
								<div id='loading'></div>
								<div id='calendar'></div>
							</tbody>
					
				
			</div>
		</div>
	</section>
</div>
