@extends('frontend.master_dashboard')
@section('main')

       <!-- Hero SLider -->
       @include('frontend.home.home_slider')
        <!--End hero slider-->
        

        @include('frontend.home.featured_cat')
        <!--End banners-->



   <!--Products Tabs-->
        @include('frontend.home.home_new_products')
        <!--Products Tabs-->




       <!-- Featured -->
       @include('frontend.home.home_featured')
        <!--featured-->









        <!-- TV Category -->

        @include('frontend.home.tv_category')
        <!--End TV Category -->





        <!-- Tshirt Category -->

        @include('frontend.home.tshirt_category')
        <!--End Tshirt Category -->


 





        <!-- Computer Category -->

        @include('frontend.home.computer')
        <!--End Computer Category -->






        
        <!--4 columns-->
        @include('frontend.home.home_columns')
        <!--End 4 columns-->









  <!--Vendor List -->

    @include('frontend.home.vendor_list')


 <!--End Vendor List -->


@endsection
