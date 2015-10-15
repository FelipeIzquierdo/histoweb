function appendVideo(video, streamid) 
{
    if( number_videos < 2 )
    {
        enableId ( 'sala' , videos_widget[ number_videos ] );
        video.width = $( '#sala' ).parent().width();    
        video_element = document.getElementById( 'sala' ) || document.body;
        number_videos = number_videos + 1;
        video = getVideo(video, streamid, video_element , number_videos );
        if ( number_videos == 2 )
        {
            $('.video_1').addClass( 'videos col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xs-push-8 col-sm-push-8 col-md-push-8 col-lg-push-8' );
        }
    }
}