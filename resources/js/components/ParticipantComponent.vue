<template>
	<div>
		<div class="container">
			<div class="row justify-content-center">
					<div class="col-md-12">
							<div class="card">
									<div class="card-header bg-orange color-white">
											<h4 class="float-left">Lista de asistentes</h4>
											<a
													class="btn btn-light float-right"
													href="javascript:void(0)"
													data-toggle="modal"
              						data-target="#parcipant-modal"
													@click="showForm(null)">
													Agregar
											</a>
									</div>
									<div class="card-body">
										<div v-if="participantList.length == 0">
											<h5 class="color-orange"> No se encontraron participantes </h5>
										</div>
										<div v-else>
											<table class="table table-hover table-striped">
												<thead>
													<tr class="vue-color">
														<th>Nombre</th>
														<th>Apellido</th>
														<th>Email</th>
														<th>Cedula</th>
														<th>ParticipantID</th>
														<th>Evento</th>
														<th>Asistencia</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="participant in participantList" :key="participant.id" @click="showParticipant(participant.id)">
														<td>{{participant.name}}</td>
														<td>{{participant.lastname}}</td>
														<td>{{participant.email}}</td>
														<td>{{participant.id_number}}</td>
														<td>{{participant.participant_id}}</td>
														<td>{{participant.event_name}}</td>
														<td>{{participant.assistance}}</td>
														<!--<td width="10px">
															<a
																href="javascript:void(0)"
																class="btn btn-sm">
																<img
																	class="w-20-px"
																	:src="'/assets/icons/eye-solid.svg'">
															</a>
														</td>
														<td width="10px">
															<a
																href="javascript:void(0)"
																class="btn btn-sm">
																<img
																	class="w-20-px"
																	:src="'/assets/icons/edit-solid.svg'">
															</a>
														</td>-->
													</tr>
												</tbody>
											</table>
										</div>
									</div>
							</div>
					</div>
			</div>
		</div>

		<participant-form-component
			:modalTitle="modalTitle"
			:participantId="participantId"
			:form="form"
			v-on:submit="submitParticipant($event)"
		></participant-form-component>

		<participant-data-component
			:participantId="participantId"
			:participant="participant"
			v-on:load="showForm"
		></participant-data-component>

	</div>
</template>

<script>

export default {
    beforeMount(){
			let self = this;
      axios.get('/participants/')
						.then( response => {
								console.log(response.data.participants);
								self.participantList = response.data.participants.data;
								self.pagInformation = response.data.participants;
						})
						.catch( error => {
							console.log(error.response);
						});
			axios.get('/events/')
						.then( response => {
								self.events = response.data.events;
						})
						.catch( error => {
							console.log(error.response);
						});
    },
    data(){
			return{
				participantList: [],
				pagInformation: {},
				modalTitle: '',
				participantId: null,
				participant: {},
				events: [],
				form: {
					name: null,
					lastname: null,
					email: null,
					type: {},
					event: {},
					id_number: null,
					address: null,
					phone: null,
					born_date: null
				}
			}
    },
    methods: {
			showForm(id){
				if( id ){
					this.modalTitle = 'Editar Paticipante';
					this.form = this.participant;
					console.log( this.form );
				}else{
					this.form = {
						name: null,
						lastname: null,
						email: null,
						type: {},
						event: {},
						id_number: null,
						address: null,
						phone: null,
						born_date: null
					}
					this.modalTitle = 'Agregar Paticipante';
				}
			},
			submitParticipant(data){
				let self = this;
				axios.get('/participants/')
							.then( response => {
									self.participantList = response.data.participants.data;
									self.pagInformation = response.data.participants;
							})
							.catch( error => {
								console.log(error.response);
							});
				$('#parcipant-modal').modal('hide');
			},
			showParticipant(participant_id){
				this.participantId = participant_id;
				axios.get(`/participants/${this.participantId}`)
						.then( response => {
							this.participant = response.data.participant;
							console.log(response);
						})
						.catch( error => {
							console.log(error.response);
						});
				$('#data-modal').modal('show');
			}
    }
}
</script>