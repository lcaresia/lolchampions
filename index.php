<!DOCTYPE html>
<html>
<head>
    <title>Champions LoL</title>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.2/vue.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.0/axios.min.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Teko' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>

    <style type="text/css">
        .search{
            margin: 10px;
        }
        .champion{
            width: 70px;
            height: 100px;
            margin: 5px;
            float: left;
            cursor: pointer;
        }

        .champion_image{
            width: 100%;
            height: auto;
            left: auto;
        }

        .champion_title{
            width: 100%;
            height: auto;
            text-align: center;
            vertical-align: middle;
        }
        .information{
            float: right;
            height: auto;
            width: 400px;
            border-radius: 3px;
        }
        .infomation_image{
            height: 120px;
            width: 120px;
            margin: 10px;
            float: left;
        }
        .perfil_champion{
            margin: 0 0 50px 0;
        }
        .information_name{
            margin: 10px 10px 0 10px;
            height: 35px;
            font-size: 35px;
            font-family: 'Passion One', cursive;
        }
        .information_title{
            margin: 0 10px 10px 10px;
            font-size: 25px;
            font-family: 'Teko', sans-serif;
            font-family: 'Dosis', sans-serif;
        }
        .information_city{
            margin: 32px 10px 10px 10px;
            font-size: 20px;
            font-family: 'Teko', sans-serif;
            font-family: 'Dosis', sans-serif;
        }
        .information_icon{
            width: 30px;
            height: 30px;
        }
        .information_attribute{
            margin: 10px;
            height: auto;
            width: auto;
            font-size: 20px;
            font-family: 'Abel', sans-serif;
        }

        @import url(https://fonts.googleapis.com/css?family=Passion+One);
        @import url(https://fonts.googleapis.com/css?family=Teko);
        @import url(https://fonts.googleapis.com/css?family=Abel);
        @import url(https://fonts.googleapis.com/css?family=Dosis);

    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="form-group search">
            <input type="search" v-model="searchText" class="form-control" placeholder="Busque por um campeão">
        </div>

        <div class="information">
            <div class="perfil_champion">
                <img class="infomation_image" v-bind:src="selected_champion.champion.img_url">
                <div class="information_name">{{selected_champion.champion.name}}</div>
                <div class="information_title">{{selected_champion.champion.title}}</div>
                <div class="information_city">{{selected_champion.champion.city}}</div>
            </div>
            <div class="information_attribute" title="Vida">
                <img class="information_icon" src="icons/life.png">
                {{selected_champion.attributes.life}}
            </div>
            <div class="information_attribute" title="Regeneração de Vida">
                <img class="information_icon" src="icons/life_regeneration.png">
                {{selected_champion.attributes.life_regeneration}}
            </div>
            <div class="information_attribute" title="Mana">
                <img class="information_icon" src="icons/mana.png">
                {{selected_champion.attributes.mana}}
            </div>
            <div class="information_attribute" title="Regeneração de Mana">
                <img class="information_icon" src="icons/mana_regeneration.png">
                {{selected_champion.attributes.mana_regeneration}}
            </div>
            <div class="information_attribute" title="Dano de Ataque">
                <img class="information_icon" src="icons/attack_damage.png">
                {{selected_champion.attributes.attack_damage}}
            </div>
            <div class="information_attribute" title="Velocidade de Ataque">
                <img class="information_icon" src="icons/attack_speed.png">
                {{selected_champion.attributes.attack_speed}}
            </div>
            <div class="information_attribute" title="Velocidade de Movimento">
                <img class="information_icon" src="icons/movement_speed.png">
                {{selected_champion.attributes.movement_speed}}
            </div>
            <div class="information_attribute" title="Armadura">
                <img class="information_icon" src="icons/armor.png">
                {{selected_champion.attributes.armor}}
            </div>
            <div class="information_attribute" title="Resistencia Mágica">
                <img class="information_icon" src="icons/magic_resistance.png">
                {{selected_champion.attributes.magic_resistance}}
            </div>
        </div>

        <div class="champion" v-for="champion in filteredChampions">
            <div v-on:click="setSelectedChampion(champion)">
                <img class="champion_image" v-bind:src="champion.champion.img_url">
                <div class="champion_title">{{champion.champion.name}}</div>
            </div>
        </div>
    </div>

</body>
</html>

<script type="text/javascript">

    new Vue({
        el: '#container',
        data: function() {
            return {
              searchText: '',
              champions: '',
              selected_champion: ''
            };
        },
        methods:{
            setSelectedChampion: function(champion){
                this.selected_champion = champion;
            }
        },
        computed: {
            filteredChampions() {
                if (!this.searchText) return this.champions;
                return this.champions.filter(el => el.champion.name.toLowerCase().includes(this.searchText.toLowerCase()));
            }
        },
        created: function(){
            axios.get('champions.json').then(({ data }) => {
               this.champions = data;
               this.selected_champion = this.champions[0];
            });
        }
    });
</script>