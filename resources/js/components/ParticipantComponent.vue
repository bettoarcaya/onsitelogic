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
													@click="showForm">
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
														<th>ParticipantID</th>
														<th>Asistencia</th>
													</tr>
												</thead>
												<tbody>
													<tr v-for="participant in participantList" :key="participant.id">
														<td>{{participant.name}}</td>
														<td>{{participant.lastname}}</td>
														<td>{{participant.email}}</td>
														<td>{{participant.participant_id}}</td>
														<td>{{participant.assistance}}</td>
														<!--<td width="10px">
															<a
																href="javascript:void(0)"
																class="btn btn-sm"
																data-toggle="modal"
																data-target="#watch-client-modal"
																v-on:click="openModal(client)">
																<img
																	class="w-20-px"
																	:src="'/assets/icons/eye-solid.svg'">
															</a>
														</td>
														<td width="10px">
															<a
																href="javascript:void(0)"
																class="btn btn-sm"
																data-toggle="modal"
																data-target="#edit-client-modal"
																v-on:click="openEditModal(client)">
																<img
																	class="w-20-px"
																	:src="'/assets/icons/edit-solid.svg'">
															</a>
														</td>
														<td width="10px">
															<a
																href="javascript:void(0)"
																class="btn btn-sm"
																data-toggle="modal"
																data-target="#delete-client-modal"
																v-on:click="openDeleteModal(client.name, client.id)">
																<img
																	class="w-20-px"
																	:src="'/assets/icons/trash-alt-solid.svg'">
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
			v-on:submit="submitParticipant($event)"
		></participant-form-component>

	</div>
</template>

<script>

export default {
    beforeMount(){
			let self = this;
      axios.get('/participants/')
						.then( response => {
								self.participantList = response.data.participants.data;
								self.pagInformation = response.data.participants;
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
				participantId: null
			}
    },
    methods: {
			showForm(){
				this.modalTitle = 'Participante'
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
			}
    }
}
</script>