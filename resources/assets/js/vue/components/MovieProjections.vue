<template>
    <div>
        <div class="block-header">
            <div class="input-group">
                <span class="input-group-addon">
                    <!-- todo add it like property -->
                    <i class="material-icons">home</i>
                </span>
                <div>
                    <select @change="setBuilding($event.target.value)" class="form-control show-tick">
                        <optgroup :label="buildingsInCity[0].city.name" v-for="buildingsInCity in allBuildings">
                            <option v-for="loopBuilding in buildingsInCity" :value="loopBuilding.id">{{loopBuilding.name}}</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="block-header">
                    <h1 class="text-center">Movies</h1>
                </div>
                <main class="grid">
                    <img :src="movie.poster_url" v-bind:class="{ selectedMovie : isSelectedMovie(movie) }" @click="setMovie(movie)" v-for="movie in buildingMovies">
                </main>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="block-header">
                    <h1 class="text-center">Projections</h1>
                </div>
                <div class="block-header">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <!-- todo add it like property -->
                            <i class="material-icons">theaters</i>
                        </span>
                        <div>
                            <span class="font-24">{{getSelectedMovieName()}}</span>
                            <!-- <select class="form-control show-tick">
                                <option selected> Select a movie..</option>
                                <option v-for="movie in buildingMovies">{{movie.name}}</option>
                            </select> -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                List of projections
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix demo-button-sizes text-center">
                                <div v-for="(projectionsInDay, dayDate, indexDate) in availableProjections" class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
                                    <p class="font-22 font-bold">{{dayDate}}</p>
                                    <!-- todo mark first day (today) with little yellow somehow-->
                                    <!-- <p style="indexDate === 0 ? background-color: #ffffb3" class="font-22 font-bold">{{dayDate}}</p> -->
                                    <a data-toggle="modal" data-target="#defaultModal" @click="setProjection(projection.projection_id)" v-for="projection in projectionsInDay" class="btn bg-blue  waves-effect">
                                        {{projection.projection_start_time}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="defaultModalLabel">{{getProjectionDescText()}}</h2>
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
    name: "movie-projections",
    components: {},
    props: {
     building_id: {
         type: String,
         required: true
     }
 },
 data: () => {
    return {
        selectedBuilding: null,
        selectedMovieId: null ,
        selectedMovieName: 'Select a movie..' ,
        availableProjections: null,
        buildingMovies: null,
        allBuildings: null,
        allSeats: null,
        selectedProjectionDate : null,
        selectedProjectionHour : null,
        selectedProjectionId : null,
        errorMessage : false,
        selectedSeatsForReservation : [],
    }
},
created() {
    axios.get(`/api/landing/building/${this.building_id}`)
    .then(response => {
        this.selectedBuilding = response.data.building;
        this.buildingMovies = response.data.building_movies;
        this.allBuildings = response.data.buildings;
    })
},
methods: {
    setMovie(movie){
        this.allSeats = null;
        this.selectedSeatsForReservation = [];

        this.selectedMovieId = movie.id;
        this.selectedMovieName = movie.name;

         let config = {
             'method': 'GET',
             'url': `/api/landing/building/${this.selectedBuilding.id}/movie/${this.selectedMovieId}`,
             'headers': {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            };

            axios(config).then((response) => {

                this.availableProjections = response.data;
               //     if (typeof(error.response.data) == "object") {
               //         this.response = error.response.data;
               //     } else {
               //         this.response = error;
               //     }
            });

    },
    isSelectedMovie(movie){
        return this.selectedMovieId === movie.id;
    },
    getSelectedMovieName(){
        return this.selectedMovieName;
    },
    setBuilding(buildingId){
        axios.get(`/api/landing/building/${buildingId}`)
        .then(response => {
            this.selectedMovieId = null;
            this.selectedMovieName = null;

            this.selectedBuilding = response.data.building;
            this.buildingMovies = response.data.building_movies;
            this.allBuildings = response.data.buildings;
            this.allSeats = null;
            this.selectedProjectionDate = null;
            this.selectedProjectionHour = null;
            this.selectedProjectionId = null;

        })
    },

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
        if(seat.reservation_type_id !== null){
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
         'url': `/api/projection/${this.selectedProjectionId}/reserve`,
         'data': {
            selectedSeats: this.selectedSeatsForReservation
         },
         'headers': {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
        };

    axios(config).then((response) => {
          this.availableProjections = response.data;
          window.location.href = "/reservations";
     }).catch((error) => {
        if(error.response.status = 401){
            window.location.href = "/login";
        }else{
           this.errorMessage = error.response.data;
       }
     });
    },
    getProjectionDescText(){
        let string = '';

        if(this.selectedBuilding !== null){
            return string.concat(
                this.selectedBuilding.name,
                ' - ',
                this.selectedMovieName,
                ' - ',
                this.selectedProjectionDate, 
                ' - ',
                this.selectedProjectionHour,
                );  
        }

        return string;

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
    border: 1px solid #ccc;
    box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
    max-width: 100%;
    opacity: 0.3;
}
.grid img:hover {
    cursor: pointer;
    opacity: 1;
}
.selectedMovie{
    opacity: 1 !important;
    border: 6px solid yellow !important;
}

.input-group-addon{
    padding: 0 5px 0 0;
}
.input-group-addon .material-icons{
    font-size: 28px;
}

</style>