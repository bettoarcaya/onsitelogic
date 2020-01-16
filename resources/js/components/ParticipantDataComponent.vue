<template>
  <div>
    <div
			class="modal fade"
			id="data-modal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="data-modal"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="">
						<div class="modal-header bg-orange">
							<h5 class="modal-title color-white">Datos del parcipante</h5>
							<button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
							</button>
						</div>
						<div class="bg-orange container padd-20 bor-btt-rad">
							<div class="text-center">
								<img class="img img-fluid img-round w-45-pc" :src="'/assets/icons/default.png'">
								<h4 class="color-white margin-t-20">{{ types[participant.type] }}</h4>
								<h5 class="color-white">ParticipantID: {{participant.participant_id}}</h5>
							</div>
						</div>
						<div class="modal-body">
							<div class="container">
								<div class="row">
									<div class="col-md-6 text-right">
										<p><b>Nombre:</b></p>
										<p><b>Cedula:</b></p>
										<p><b>Direccion:</b></p>
										<p><b>Telefono:</b></p>
										<p><b>Fecha de nacimiento:</b></p>

										<!--<p><b>Nombre:</b> <span class="float-right">{{`${participant.name} ${participant.lastname}`}}</span></p>
										<p><b>Cedula:</b> <span class="float-right">{{ participant.id_number }} </span></p>
										<p><b>Direccion:</b> <span class="float-right">{{ participant.address }} </span></p>
										<p><b>Telefono:</b>  <span class="float-right">{{ participant.phone }}</span></p>
										<p><b>Fecha de Nacimiento:</b> <span class="float-right">{{ participant.born_date }}</span></p>-->
									</div>
									<div class="col-md-6">
										<p> {{`${participant.name} ${participant.lastname}`}} </p>
										<p> {{ participant.id_number }} </p>
										<p> {{ participant.address }} </p>
										<p> {{ participant.phone }} </p>
										<p> {{ participant.born_date }} </p>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" id="edit-btn" class="btn bg-orange color-white">Editar</button>
						</div>
					</div>
				</div>
			</div>
    </div>
  </div>
</template>

<script>
export default {
	props: ['participantId', 'participant'],
	data(){
		return{
			types: {
				1: 'Visitante',
				2: 'Exponente',
				3: 'Asesor'
			}
		}	
	},
	methods: {
		
	}
}
</script>