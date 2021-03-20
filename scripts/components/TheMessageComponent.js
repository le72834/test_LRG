export default{
    props: ['people'],

    data: function() {
        return {
            
            myName: this.people.name,
            myPrice: this.people.role
        
           
        }
    },
    template: `<li class ="people-pic" @click="logClicked"> <img :src="'images/' + people.avatar" :alt='people.name + " image"' >
        <p>{{people.name}} </p>
    
        
        </li>`,

        created: function () {
            console.log(`created ${this.people.name}'s card`);
            // this.showProfData();
            
            
        },
        
        methods: {
            logClicked() {
                console.log(`fired from inside ${this.people.name}'s component!`);
                this.$emit("showmydata", this.people)

                    
            },
            
    }
}