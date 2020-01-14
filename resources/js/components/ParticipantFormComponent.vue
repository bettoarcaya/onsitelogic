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
						<form method="post" @submit.prevent="submit">
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
										name="name">
								</div>
								<div class="form-group">
									<label for="client_name">Apellido <span class="required-color">*</span></label>
									<input
										type="text"
										id="participant_lastname"
										class="form-control"
										placeholder="Apellido"
										name="lastname">
								</div>
								<div class="form-group">
									<label for="client_name">Email <span class="required-color">*</span></label>
									<input
										type="text"
										id="participant_email"
										class="form-control"
										placeholder="Email"
										name="email">
								</div>
								<div class="form-group">
									<label for="participant_type">Tipo</label>
									<select id="participant_type" class="form-control custom-select" name="type">
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
		props: ['modalTitle'],
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
				types: []
			}
		},
		methods: {
			submit(){

			}
		}
}
</script>