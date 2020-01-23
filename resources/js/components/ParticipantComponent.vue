<template>
	<div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-orange color-white">
								<h4 class="float-left">Assistance list</h4>
								<a
									class="float-right"
									href="javascript:void(0)"
									data-toggle="modal"
									data-target="#parcipant-modal"
									@click="showForm(null)">
									<img class="w-20" :src="'/assets/icons/plus-solid.svg'">
								</a>
								<a href="javascript:void(0)" class="float-right margin-r-20" @click="showSearch = !showSearch">
									<img class="w-20" :src="'/assets/icons/search-solid.svg'">
								</a>
						</div>
						<div class="card-body">
							<div class="search-box" v-if="showSearch">
								<form method="post" @submit.prevent="submitSearch">
									<div class="row">
										<div class="col-md-2">
											<label for="filter_by">Filter by:</label>
											<select id="filter_by" class="form-control custom-select" v-model="filterBy" name="filter">
												<option
													v-for="option in options"
													:key="option.id"
													:value="{id: option.id, name: option.name}">
													{{ option.name }}
												</option>
											</select>
										</div>
										<div class="col-md-8" style="margin-top:7px;">
											<label for=""></label>
											<input
												type="text"
												class="form-control"
												placeholder="Search participant"
												name="search"
												autocomplete="off"
												v-model="search">
										</div>
										<div class="col-md-2">
											<label for="sort_by">Sort by:</label>
											<select id="sort_by" class="form-control custom-select" v-model="sortBy" name="sort" @change="sort">
												<option value="Assistance">Assistance</option>
												<option value="No-Assistance">No-Assistance</option>
											</select>
										</div>
									</div>
								</form>
							</div>
							<div v-if="participantList.length == 0">
								<h5 class="color-orange"> There are not participants</h5>
							</div>
							<div v-else>
								<table class="table table-hover table-striped">
									<thead>
										<tr class="vue-color">
											<th>Name</th>
											<th>Lastname</th>
											<th>Email</th>
											<th>ID number</th>
											<th>ParticipantID</th>
											<th>Event</th>
											<th>Assistance</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="participant in participantList" :key="participant.id" @click="showParticipant(participant.id)" style="cursor: pointer">
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
								<div class="btn-group" v-if="pagInformation.total > 10">
									<button
										class="btn vue-color-btn btn-sm"
										@click="prevPage"
										v-if="pagInformation.current_page !== 1">
										<img class="w-10" :src="'/assets/icons/chevron-left-solid.svg'">
									</button>
									<button
										class="btn vue-color-btn btn-sm"
										@click="nextPage"
										v-if="pagInformation.current_page !== pagInformation.last_page">
										<img class="w-10" :src="'/assets/icons/chevron-right-solid.svg'">
									</button>
								</div>
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
			v-on:delete="deleteUser"
		></participant-data-component>

	</div>
</template>

<script>

export default {
		props: ['lang'],
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
				filterBy: {id: 'name', name: 'Name'},
				sortBy: 'Assistance',
				search: '',
				showSearch: false,
				options: [
					{id: 'name', name: 'Name'},
					{id: 'lastname', name: 'Lastname'},
					{id: 'email', name: 'Email'},
					{id: 'id_number', name: 'ID Number'},
					{id: 'event_name', name: 'Event name'},
				],
				sortOptions: [
					{id: 1, name: 'Assistance'},
					{id: 2, name: 'No-Assistance'},
				],
				modalTitle: '',
				participantId: null,
				participant: {},
				events: [],
				form: {
					id: null,
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
					this.modalTitle = 'Edit Participant';
					this.form = this.participant;
				}else{
					this.form = {
						id: id,
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
					this.modalTitle = 'Add Participant';
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
						})
						.catch( error => {
							console.log(error.response);
						});
				$('#data-modal').modal('show');
			},
			submitSearch(){
				let self = this;
				const data = {
					filterBy: this.filterBy,
					search: this.search
				};
				axios.post('/participants/search', data)
					.then( response => {
						self.participantList = response.data.participants.data;
						self.pagInformation = response.data.participants;
					})
					.catch( error => {
						console.log(error);
					});
			},
			deleteUser(){
				let self = this;
				axios.delete(`/participants/${this.participantId}`)
					.then( response => {
						this.message('success', 'Participant successfully removed');
						self.participantList = response.data.participants.data;
						self.pagInformation = response.data.participants;
					})
					.catch(error => {
						console.log(error)
						this.message('error', 'Something is wrong, please try again');
					});
			},
			sort(){
				if( this.sortBy == 'Assistance'){
					this.participantList.sort(function (a, b) {
						if (a.assistance < b.assistance) {
							return 1;
						}
						if (a.assistance > b.assistance) {
							return -1;
						}
						// a must be equal to b
						return 0;
					});
				}else{
					this.participantList.sort(function (a, b) {
						if (a.assistance > b.assistance) {
							return 1;
						}
						if (a.assistance < b.assistance) {
							return -1;
						}
						// a must be equal to b
						return 0;
					});
				}
				
			},
			prevPage(){
				let self = this;
        axios.get(this.pagInformation.prev_page_url)
					.then( response => {
						self.participantList = response.data.participants.data;
						self.pagInformation = response.data.participants;
					})
					.catch( error => {
							console.log(error.response);
					});
			},
			nextPage(){
				let self = this;
        axios.get(this.pagInformation.next_page_url)
					.then( response => {
						self.participantList = response.data.participants.data;
						self.pagInformation = response.data.participants;
					})
					.catch( error => {
							console.log(error.response);
					});
			},
			message(status, msg){
        const Swal = require('sweetalert2');
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: status,
            title: msg
        });
      }
    }
}
</script>