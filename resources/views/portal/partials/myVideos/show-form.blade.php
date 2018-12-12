<div id="myModal{{ $video['video']->id }}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <div class="row order-form">
                    <form id="userForm">

                        <div class="form-group">
                            <label for="workshop"> Check here if you attended a live Pinnacle Workshop.</label>
                            <input type="checkbox" id="workshop" name="workshop"
                                   value="{{$video['video']->orders->getIna('workshop')}}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="title"> Title of your video. * </label>
                            <input id="title" type="text" name="title" class="form-control"
                                   value="{{$video['video']->orders->getIna('title')}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="whoisfor"> Describe the audience for whom this message is to be delivered.
                                * </label>
                            <textarea id="whoisfor" name="whoisfor" class="form-control" required rows="3" cols="30"
                                      disabled>{{$video['video']->orders->getIna('whoisfor')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="challenge"> What challenge stands in the way of this audience understanding and
                                acting on your message? </label>
                            <textarea id="challenge" name="challenge" class="form-control" required rows="3" cols="30"
                                      disabled> {{$video['video']->orders->getIna('challenge')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="takeaway"> What are the key takeaways you want them to absorb from your message?
                                * </label>
                            <textarea id="takeaway" name="takeaway" class="form-control" required rows="3" cols="30"
                                      disabled>{{$video['video']->orders->getIna('takeaway')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="react"> What is the behavior or reaction you wish to induce from your audience?
                                * </label>
                            <textarea id="react" name="react" class="form-control" required rows="3" cols="30" disabled
                            >{{$video['video']->orders->getIna('react')}}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <label for="misc"> Please provide any additional background information or comments
                                    about
                                    your
                                    material, audience, forum or desired outcomes that may be helpful for your coach.
                                    * </label>
                                <textarea id="misc" name="misc" class="form-control" required rows="3" cols="30"
                                          disabled>{{ $video['video']->orders->getIna('misc') }}
                                </textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

