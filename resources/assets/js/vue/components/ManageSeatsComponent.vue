<template>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Manage seats</h2>
            </div>
            <div class="body table-responsive">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table">
                        <tbody v-for="row in allSeats">
                            <td v-for="seat in row" >
                                <button style="padding-top:8px;padding-bottom:8px;" @click="selectSeat(seat)" v-bind:class="setSeatStatus(seat)" class="btn btn-xs btn-block waves-effect" type="button">
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
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios/dist/axios.js'


export default {
    name: "service",
    components: {},
    props: {
       building_id: {
           type: String,
           required: true
       },
       room_id:{
           type: String,
           required: true
       }
   },
   data: () => {
    return {
        allSeats: null,
    }
},
created() {
    axios.get(`/api/building/${this.building_id}/room/${this.room_id}/seats`)
    .then(response => {
        this.allSeats = response.data;

        // this.services.forEach((service, index) => {
        //     let formatted_float_price_for_first_period = parseFloat(service.price_for_first_period);
        //     let subscription = (this.services[index]['subscription'] == 1);

        //     this.services[index]['selectedPrice'] = 0;
        //     this.services[index]['totalPrice'] = formatted_float_price_for_first_period;
        //     this.services[index]['price_for_first_period'] = formatted_float_price_for_first_period;
        //     this.services[index]['subscription'] = subscription;
        //     this.services[index]['dbSubscriptionStatus'] = subscription;
        // })
    })
},
methods: {
    setSeatStatus(seat){
        if(seat.reservable === 1){
            return  'bg-green';
        } else {
            return 'bg-blue';
            // return 'bg-gray';
        }
    },
    getSeatIcon(seat){
        if(seat.reservable === 1){
            return  'event_seat';
        } else {
            return 'view_week';
        }
    },
    selectSeat(seat){
        let config = {
         'method': 'POST',
         'url': `/api/seat/${seat.id}`,
         'headers': {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        };

        axios(config).then((response) => {
            seat.reservable = 1-seat.reservable;
           //     if (typeof(error.response.data) == "object") {
           //         this.response = error.response.data;
           //     } else {
           //         this.response = error;
           //     }
        });
    }
}
}
</script>
