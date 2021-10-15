@extends('../layoutPrincipal')

@section('includes')
@include('./includes.appbar')
<v-main class="grey lighten-3">
   <router-view></router-view>
</v-main>

@endsection

