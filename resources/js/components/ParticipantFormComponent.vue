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
									<span aria-hidden="true"><img :src="'/assets/dismiss.svg'"></span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="client_name">Nombre <span class="required-color">*</span></label>
									<input
										type="text"
										id="participant_name"
										class="form-control"
										placeholder="Nombre"
										name="name"
										autocomplete="off"
										v-model="form.name">
								</div>
								<div class="form-group">
									<label for="client_name">Apellido <span class="required-color">*</span></label>
									<input
										type="text"
										id="participant_lastname"
										class="form-control"
										placeholder="Apellido"
										name="lastname"
										autocomplete="off"
										v-model="form.lastname">
								</div>
								<div class="form-group">
									<label for="client_name">Email <span class="required-color">*</span></label>
									<input
										type="text"
										id="participant_email"
										class="form-control"
										placeholder="Email"
										name="email"
										autocomplete="off"
										v-model="form.email">
								</div>
								<div class="form-group">
									<label for="participant_type">Tipo</label>
									<select id="participant_type" class="form-control custom-select" v-model="form.type" name="type">
										<option
											v-for="type in types"
											:key="type.id"
											:value="{id: type.id, name: type.type}">
											{{type.type}}
										</option>
									</select>
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
		props: ['modalTitle', 'participantId'],
		beforeMount(){
			let self = this;
      axios.get('/participants/types/')
						.then( response => {
								self.types = response.data.types;
						})
						.catch( error => {
							console.log(error.response);
						});
		},
    data(){
			return{
				types: [],
				validateFlag: true,
				form: {
					name: null,
					lastname: null,
					email: null,
					type: {}
				}
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
									console.log(error.response);
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