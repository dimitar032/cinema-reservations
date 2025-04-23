<template>
    <div>
        <h1>{{this.selectedBuildingName}}</h1>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h2>Find reservation..</h2>
            <div class="block-header">
                <div class="input-group">
                    <!-- {{-- todo later drop down with twitter search --}} -->
                    <a data-toggle="modal" data-target="#findReservationModal" @click="findReservation()" class="btn btn-primary waves-effect" style="width: 5%;">FIND</a>
                    <input type="" name="" v-model="inputSearchParameter" class="show-tick" style="width: 92%; background-color: white;" placeholder="Enter email or username ..">   
                </div>
            </div>
        </div>

        <div class="modal fade" id="findReservationModal" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="findReservationModal">Results for "{{this.inputSearchParameter}}"</h2>
                        <div class="body">
                            <div class="list-group">
                                    <a class="list-group-item" @click="changeFoundedReservation(index)" :class="{ 'active': userReservation.projection_id === currentlySelectedUserReservation.projection_id }" v-for="(userReservation,index) in foundedUsersReservations" style="cursor:pointer;">
                                        <h4 class="list-group-item-heading">
                                            <div class="align-left"> 
                                                <span>{{userReservation.user_name}}</span>
                                                <span style="text-decoration: underline;"><{{userReservation.user_email}}></span>
                                            </div>
                                            <div class="align-right"> 
                                                <span>{{userReservation.movie_name + " - " + userReservation.projection_start_time}}</span>
                                            </div>
                                        </h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">

                            <!-- <div @v-if="errorMessage" class="alert alert-danger"> -->
                                <div @v-if="errorMessage" v-bind:class="{ 'alert alert-danger' : errorMessage }">
                                    <strong>{{errorMessage.message}}</strong>
                                    <ul>
                                        <li v-for="errorText in errorMessage.errors">{{errorText}}</li>
                                    </ul>
                                </div>


                                    {{getCurrentlySelectedUserReservation()}}

                                <div class="body table-responsive">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table">
                                            <tbody v-for="row in getProjectionAllSeatsAndUserReservedSeats">
                                                <td v-for="seat in row" >
                                                    <button style="padding-top:8px;padding-bottom:8px;" @click="selectSeat(seat)"  v-bind:class="setSeatStatus(seat)" class="btn btn-xs btn-block waves-effect" type="button">
                                                        <div class="demo-google-material-icon">
                                                            <i class="material-icons">{{getSeatIcon(seat)}}</i>
                                                            <span class="icon-name"></span>
                                                        </div>
                                                    </button>
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:100px;">
                                        <button class="btn bg-cyan btn-lg btn-block" type="button">
                                            <div class="demo-google-material-icon">
                                                <i class="material-icons">airplay</i>
                                                <span class="icon-name"></span>
                                                <span class="badge">S C R E E N</span>
                                                <i class="material-icons">airplay</i>
                                                <span class="icon-name"></span>
                                            </div>
                                        </button>
                                    </div>
                                </div>


                       <!--  <h3 class="text-center">Tickets</h3>
                        
                        <div class="col-md-3" v-for="ticket in selectedSeatsForReservation">
                            <div class="input-group input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">movie_creation</i>
                                </span>
                                <div class="form-line">
                                   <select @change="setTicketType($event.target.value)" class="form-control show-tick">
                                    <option value="1">Normal</option>
                                    <option value="2">Child</option>
                                    <option value="3">Elder</option>
                                </select>
                            </div>
                          </div>
                      </div>   -->    

                  </div>

                  <div class="modal-footer">
                    <button type="button" @click="makeReservation()" class="btn btn-link waves-effect">RESERVE</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>




    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h2>Direct sell</h2>
        <div v-for="(projectionsInHour,projectionHourGroup) in todayProjectsGroupedByHour">
            <main class="grid">
                <span>{{projectionHourGroup + ':00'}}</span>
                <a data-toggle="modal" data-target="#defaultModal" @click="setProjection(projection.projection_id)" v-for="projection in projectionsInHour">
                    <img :src="projection.movie_poster_url" data-toggle="tooltip" data-placement="bottom" :data-original-title="projection.movie_name + ' - ' + projection.start_time">
                </a>
            </main>
            <hr class="padding10topbot">
        </div>
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="defaultModalLabel">getProjectionDescText</h2>
                </div>
                <div class="modal-body">

                    <!-- <div @v-if="errorMessage" class="alert alert-danger"> -->
                        <div @v-if="errorMessage" v-bind:class="{ 'alert alert-danger' : errorMessage }">
                            <strong>{{errorMessage.message}}</strong>
                            <ul>
                                <li v-for="errorText in errorMessage.errors">{{errorText}}</li>
                            </ul>
                        </div>

                        <div class="body table-responsive">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table class="table">
                                    <tbody v-for="row in allSeats">
                                        <td v-for="seat in row" >
                                            <button style="padding-top:8px;padding-bottom:8px;" @click="selectSeat(seat)"  v-bind:class="setSeatStatus(seat)" class="btn btn-xs btn-block waves-effect" type="button">
                                                <div class="demo-google-material-icon">
                                                    <i class="material-icons">{{getSeatIcon(seat)}}</i>
                                                    <span class="icon-name"></span>
                                                </div>
                                            </button>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                            


                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:100px;">
                                <button class="btn bg-cyan btn-lg btn-block" type="button">
                                    <div class="demo-google-material-icon">
                                        <i class="material-icons">airplay</i>
                                        <span class="icon-name"></span>
                                        <span class="badge">S C R E E N</span>
                                        <i class="material-icons">airplay</i>
                                        <span class="icon-name"></span>
                                    </div>
                                </button>
                            </div>
                        </div>


                       <!--  <h3 class="text-center">Tickets</h3>
                        
                        <div class="col-md-3" v-for="ticket in selectedSeatsForReservation">
                            <div class="input-group input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">movie_creation</i>
                                </span>
                                <div class="form-line">
                                   <select @change="setTicketType($event.target.value)" class="form-control show-tick">
                                    <option value="1">Normal</option>
                                    <option value="2">Child</option>
                                    <option value="3">Elder</option>
                                </select>
                            </div>
                          </div>
                      </div>   -->    

                  </div>

                  <div class="modal-footer">
                    <button type="button" @click="makeReservation()" class="btn btn-link waves-effect">RESERVE</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>



</div>
</template>

<script>

export default {
    name: "employee-projections",
    components: {},
    props: {
       building_id: {
           type: String,
           required: true
       },
       building_name: {
           type: String,
           required: true
       }
   },
   data: () => {
    return {
        selectedBuildingName: null,
        todayProjectsGroupedByHour: null,

        errorMessage : false,
        selectedSeatsForReservation : [],
        allSeats: null,
        selectedProjectionDate : null,
        selectedProjectionHour : null,
        selectedProjectionId : null,

        inputSearchParameter: null,
        foundedUsersReservations: null,
        currentlySelectedUserReservation: null,
        getProjectionAllSeatsAndUserReservedSeats: [],

    }
},
created() {
    this.selectedBuildingName = this.building_name;

    axios.get(`/api/employee/building/${this.building_id}/projections`)
    .then(response => {
        this.todayProjectsGroupedByHour = response.data;
    })
},
methods: {
        // isSelectedMovie(movie){
        //     return this.selectedMovieId === movie.id;
        // },

   // projection related
   setProjection(projectionId){
    axios.get(`/api/projection/${projectionId}/seats`)
    .then(response => {
        this.errorMessage = false;
        this.selectedSeatsForReservation = [];
        this.allSeats = response.data.all_seats;
        this.selectedProjectionDate = response.data.projection.formatted_date;
        this.selectedProjectionId = response.data.projection.id;
        this.selectedProjectionHour = response.data.projection.formatted_hour;
    })
},
isSeatReserved(seat){
    return seat.reservation_type_id !== null
},
setSeatStatus(seat){
    if(seat.user_reserved === 1){
        return  'bg-blue';
    }else if(seat.reservation_type_id !== null){
        return  'bg-red';
    }else if(seat.reservable === 1){
        return  'bg-green';
    } else {
        return 'bg-orange';
    }
},
getSeatIcon(seat){
    if(seat.reservable === 1){
        return  'event_seat';
    } else {
        return 'done';
    }
},
selectSeatForReservation(seat){
    if(this.selectedSeatsForReservation.indexOf(seat.id) > -1){
        this.selectedSeatsForReservation = this.selectedSeatsForReservation.filter(function(e) { return e !== seat.id })
        seat.reservable = 1-seat.reservable;
        this.selectedSeatsForReservation.splice(seat.id,1);
    }else{
        if(this.selectedSeatsForReservation.length <= 3){
            seat.reservable = 1-seat.reservable;
            this.selectedSeatsForReservation.push(seat.id);
        }
    }
},
selectSeat(seat){
    if(!this.isSeatReserved(seat)){
        this.selectSeatForReservation(seat);
    }
},
makeReservation(){
    let config = {
     'method': 'POST',
     'url': `/api/employee/projection/${this.selectedProjectionId}/reserve`,
     'data': {
        selectedSeats: this.selectedSeatsForReservation
    },
    'headers': {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
};

axios(config).then((response) => {
  this.availableProjections = response.data;
  window.location.reload();
}).catch((error) => {
        // if(error.response.status = 401){
            // window.location.href = "/login";
        // }else{
           this.errorMessage = error.response.data;
       // }
   });
},

    //finding reservations..
    findReservation(){
        let config = {
         'method': 'GET',
         'url': `/api/employee/building/${this.building_id}/find-reservation/?searchParam=${this.inputSearchParameter}`,
         'data': {
            // selectedSeats: this.selectedSeatsForReservation
        },
        'headers': {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
   };

   axios(config).then((response) => {
    console.log(response.data);
    this.foundedUsersReservations = response.data;
    this.changeFoundedReservation(0); //select the first founded user reservation
          // window.location.reload();
      }).catch((error) => {
        // if(error.response.status = 401){
            // window.location.href = "/login";
        // }else{
           this.errorMessage = error.response.data;
       // }
   });



  },
  getCurrentlySelectedUserReservation(){
    if(this.currentlySelectedUserReservation != null){
        return this.currentlySelectedUserReservation.name;
    }else{
        return null;
    }
  },
  changeFoundedReservation(index){
     this.currentlySelectedUserReservation = this.foundedUsersReservations[index];

    //finding aall seats + user reserved seats..
        let config = {
         'method': 'GET',
         'url': `/api/employee/projection/${this.currentlySelectedUserReservation.projection_id}/user/${this.currentlySelectedUserReservation.user_id}/get-all-seats`,
         'data': {
            // selectedSeats: this.selectedSeatsForReservation
        },
        'headers': {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
   };

   axios(config).then((response) => {
        this.getProjectionAllSeatsAndUserReservedSeats = response.data;
      }).catch((error) => {
        // if(error.response.status = 401){
            // window.location.href = "/login";
        // }else{
           this.errorMessage = error.response.data;
       // }
   });


  },
setNewUserReservation(){

  }



}
}

</script>

<style scoped>
.grid { 
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-gap: 20px;
    align-items: stretch;
}
.grid img {
    box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.5);
    border: 1px solid #ccc;
}
.grid img ,.grid span {
    max-width: 100%;
    opacity: 0.5;
}
.grid span {
    // remove at the end
    box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.5);
    background-color: #e9e9e9;
    padding-top:102px;
    text-align: center;
    font-size: 56px; 
    color: black; 
}
.grid img:hover {
    cursor: pointer;
    opacity: 1;
}

.input-group-addon{
    padding: 0 3px 0 0;
}
.input-group-addon .material-icons{
    font-size: 28px;
}
.padding10topbot{
    padding: 10px 0;
    border-top: 2px solid white !important;

}
</style>