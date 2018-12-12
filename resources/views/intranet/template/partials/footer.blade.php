        </div>
    </div>
</div>
</section>
<footer id="footer">
    <div class="footer-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-md-push-4 footer-form">
                    <p>@lang('intranet/template.footer.text')</p>
                    <form class="form-inline" name="ccoptin" action="//visitor.constantcontact.com/d.jsp"
                          target="_blank" method="post">
                        <div class="form-group col-xs-12 col-sm-10 col-sm-offset-1">
                            <div class="input-group">
                                <input type="email" class="form-control footer-input"
                                       placeholder="{{trans('intranet/template.footer.input.placeholder')}}">
                                <div class="input-group-addon">
                                    <input type="submit" name="go" class="btn btn-primary"
                                           value="{{trans('intranet/template.footer.input.submit')}}">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="m" value="1101971666321"> <input type="hidden" name="p" value="oi">
                    </form>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-md-pull-5 social">
                    <a href="http://www.facebook.com/PinnaclePerformance" target="_blank" class="sprite facebook"></a>
                    <a href="http://www.twitter.com/Pinnacletweets" target="_blank" class="sprite twitter"></a>
                    <a href="http://www.linkedin.com/company/pinnacle-performance-company" target="_blank"
                       class="sprite linkedin"></a>
                    <a href="http://www.youtube.com/user/PinnaclePerfCompany" target="_blank"
                       class="sprite youtube"></a>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3 copyright">
                    <a target="_blank" href="/speeches" class="sprite iw-logo pull-right"></a>
                    <span>
                        	&copy;{{date('Y')}} Pinnacle Performance Company
			<br>
			<a href="/intranet" class="small text-grey">Intranet</a>
                 </span>
                </div>
            </div>
        </div>
    </div>
</footer>
