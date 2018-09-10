@extends('layouts.app')

@section('content')
    <App/>
    <!--
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <vue-topprogress ref="topProgress1"></vue-topprogress>
                    <div class="card-body">
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                        </p>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                        </p>
                        <vue-element-loading :active="isActive1" spinner="spinner" color="slateblue"/>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" @click="isActive1 = true">Show Loading</button>
                        <button class="btn btn-info text-white" @click="$refs.topProgress1.start()">Show Progress Bar</button>
                        <button class="btn btn-warning" @click="showMessage()">Show Notification</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <vue-topprogress ref="topProgress2"></vue-topprogress>
                    <div class="card-body">
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                        </p>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi nisi dolores esse, architecto laborum necessitatibus recusandae doloremque praesentium omnis eum perspiciatis dolorem et, aspernatur consectetur? Illo nihil non libero beatae!
                        </p>
                        <vue-element-loading :active="isActive2" spinner="spinner" color="slateblue"/>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" @click="isActive2 = true">Show Loading</button>
                        <button class="btn btn-info text-white" @click="$refs.topProgress2.start()">Show Progress Bar</button>
                        <button class="btn btn-warning" @click="showMessage()">Show Notification</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
@endsection
