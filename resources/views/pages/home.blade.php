@extends('../layoutPrincipal')

@section('includes')
@include('./includes.appbar')
<v-main class="grey lighten-4">
   <router-view></router-view>
</v-main>

@endsection

