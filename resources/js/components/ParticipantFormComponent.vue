<template>
		<div
			class="modal fade"
			id="parcipant-modal"
			tabindex="-1"
			role="dialog"
			aria-labelledby="parcipant-modal"
			aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="">
						<form method="post" @submit.prevent="submit" autocomplete="off">
							<div class="modal-header bg-orange">
								<h5 class="modal-title color-white">{{ modalTitle }}</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true"><img :src="'/assets/icons/dismiss.svg'"></span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="form-group col-md-6">
										<label for="client_name">Nombre <span class="required-color">*</span></label>
										<input
											type="text"
											id="participant_name"
											class="form-control"
											placeholder="Nombre"
											name="name"
											autocomplete="off"
											v-model="form.name">
											<small class="form-control-feedback" v-if="errors.name" v-text="errors.name[0]"></small>
									</div>
									<div class="form-group col-md-6">
										<label for="client_name">Apellido <span class="required-color">*</span></label>
										<input
											type="text"
											id="participant_lastname"
											class="form-control"
											placeholder="Apellido"
											name="lastname"
											autocomplete="off"
											v-model="form.lastname">
											<small class="form-control-feedback" v-if="errors.lastname" v-text="errors.lastname[0]"></small>
									</div>
									<div class="form-group col-md-6">
										<label for="client_name">Email <span class="required-color">*</span></label>
										<input
											type="text"
											id="participant_email"
											class="form-control"
											placeholder="Email"
											name="email"
											autocomplete="off"
											v-model="form.email">
											<small class="form-control-feedback" v-if="errors.email" v-text="errors.email[0]"></small>
									</div>
									<div class="form-group col-md-6">
										<label for="client_name">Cedula de identidad <span class="required-color">*</span></label>
										<input
											type="text"
											id="participant_idnumber"
											class="form-control"
											placeholder="Cedula de identidad"
											name="id_number"
											autocomplete="off"
											v-model="form.id_number">
											<small class="form-control-feedback" v-if="errors.id_number" v-text="errors.id_number[0]"></small>
									</div>
									<div class="form-group col-md-6">
										<label for="participant_type">Tipo <span class="required-color">*</span></label>
										<select id="participant_type" class="form-control custom-select" v-model="form.type" name="type">
											<option
												v-for="type in types"
												:key="type.id"
												:value="{id: type.id, name: type.type}">
												{{type.type}}
											</option>
										</select>
										<small class="form-control-feedback" v-if="errors.type" v-text="errors.type[0]"></small>
									</div>
									<div class="form-group col-md-6">
										<label for="participant_event">Evento <span class="required-color">*</span></label>
										<select id="participant_event" class="form-control custom-select" v-model="form.event" name="event">
											<option
												v-for="event in events"
												:key="event.id"
												:value="{id: event.id, name: event.event_name}">
												{{event.event_name}}
											</option>
										</select>
										<small class="form-control-feedback" v-if="errors.event" v-text="errors.event[0]"></small>
									</div>
									<div class="form-group col-md-12">
										<label for="client_name">Direccion</label>
										<input
											type="text"
											id="participant_address"
											class="form-control"
											placeholder="Direccion"
											name="address"
											autocomplete="off"
											v-model="form.address">
									</div>
									<div class="form-group col-md-6">
										<label for="client_name">Telefono</label>
										<input
											type="text"
											id="participant_phone"
											class="form-control"
											placeholder="Telefono"
											name="phone"
											autocomplete="off"
											v-model="form.phone">
									</div>
									<div class="form-group col-md-6">
										<label for="client_name">Fecha de nacimiento</label>
										<input
											type="date"
											id="participant_date"
											class="form-control"
											placeholder="Fecha de nacimiento"
											name="born_date"
											autocomplete="off"
											v-model="form.born_date">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              	<button type="submit" id="submit-btn" class="btn bg-orange color-white">Agregar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</template>

<script>
export default {
		props: ['modalTitle', 'participantId', 'form'],
		beforeMount(){
			let self = this;
      axios.get('/events/')
						.then( response => {
								self.events = response.data;
								console.log(response.data);
						})
						.catch( error => {
							console.log(error.response);
						});
		},
    data(){
			return{
				types: [
					{id: 1, type: 'Visitante'},
					{id: 2, type: 'Exponente'},
					{id: 3, type: 'Asesor'}
				],
				events: [],
				validateFlag: true,
				errors: {},
			}
		},
		methods: {
			submit(){
				this.validateForm();
				
				if( this.validateFlag ){
					let self = this;
					axios.post('/participants/', this.form)
								.then( response => {
									this.message('success', 'Usuario guardado satisfactoriamente');
									this.$emit('submit', {});
								})
								.catch( error => {
									if( error.response.status == 422 ){
										self.errors = error.response.data.errors
									}
									this.message('error', 'Ha ocurrido un error por favor intente nuevamente');
								});
				}else{
					this.message('error', 'Existen campos requeridos que no han sido completados');
				}
				
			},
			validateForm(){
				for (const key in this.form) {
					if( this.form[key] == '' || this.form[key] == null ){
						this.validateFlag = false;
					}
				}
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