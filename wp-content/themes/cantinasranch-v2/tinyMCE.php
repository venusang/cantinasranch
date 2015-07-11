<?php

add_action('admin_head', 'add_custom_buttons');
function add_custom_buttons() { 
wp_print_scripts( 'quicktags'); ?>
		
<script type='text/javascript'>
	
		
		edButtons[edButtons.length] = new edButton('tws_quote',
		
			'Quote',
			'[quote] ',
			' [/quote] ',
			''
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_hr',
		
			'HR',
			'[hr] ',
			''
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_intro',
		
			'Intro Text',
			'[intro] ',
			'[/intro]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_dropcap_title_only',
		
			'Dropcap Title Only',
			'[dropcap_title_only] ',
			'[/dropcap_title_only]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_dropcap_box',
		
			'Dropcap Container',
			'[dropcap_box] ',
			'[/dropcap_box]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_dropcap_title',
		
			'Dropcap Title',
			'[dropcap_title] ',
			'[/dropcap_title]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_dropcap_content',
		
			'Dropcap Content',
			'[dropcap_content] ',
			'[/dropcap_content]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_pullquoteleft',
		
			'Quote Left',
			'[pullquoteleft] ',
			'[/pullquoteleft]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_pullquoteright',
		
			'Quote Right',
			'[pullquoteright] ',
			'[/pullquoteright]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_alert_standard',
		
			'Alert Standard',
			'[alert_standard] ',
			'[/alert_standard]'
		
		);		
		
		edButtons[edButtons.length] = new edButton('tws_alert_green',
		
			'Alert Green',
			'[alert_green] ',
			'[/alert_green]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_alert_red',
		
			'Alert Red',
			'[alert_red] ',
			'[/alert_red]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_alert_blue',
		
			'Alert Blue',
			'[alert_blue] ',
			'[/alert_blue]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_alert_yellow',
		
			'Alert Yellow',
			'[alert_yellow] ',
			'[/alert_yellow]'
		
		);
		
		
		edButtons[edButtons.length] = new edButton('tws_highlight_text',
		
			'Highlight Text',
			'[highlight_text] ',
			'[/highlight_text]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_half_first',
		
			'1/2 First',
			'[one_half_first] ',
			'[/one_half_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_half',
		
			'1/2',
			'[one_half] ',
			'[/one_half]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_third_first',
		
			'1/3 First',
			'[one_third_first] ',
			'[/one_third_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_third',
		
			'1/3',
			'[one_third] ',
			'[/one_third]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_fourth_first',
		
			'1/4 First',
			'[one_fourth_first] ',
			'[/one_fourth_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_fourth',
		
			'1/4',
			'[one_fourth] ',
			'[/one_fourth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_fifth_first',
		
			'1/5 First',
			'[one_fifth_first] ',
			'[/one_fifth_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_fifth',
		
			'1/5',
			'[one_fifth] ',
			'[/one_fifth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_sixth_first',
		
			'1/6 First',
			'[one_sixth_first] ',
			'[/one_sixth_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_one_sixth',
		
			'1/6',
			'[one_sixth] ',
			'[/one_sixth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_two_third_first',
		
			'2/3 First',
			'[two_third_first] ',
			'[/two_third_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_two_third',
		
			'2/3',
			'[two_third] ',
			'[/two_third]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_three_fourth_first',
		
			'3/4 First',
			'[three_fourth_first] ',
			'[/three_fourth_first]'
		
		);
				
		edButtons[edButtons.length] = new edButton('tws_three_fourth',
		
			'3/4',
			'[three_fourth] ',
			'[/three_fourth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_two_fifth_first',
		
			'2/5 First',
			'[two_fifth_first] ',
			'[/two_fifth_first]'
		
		);
				
		edButtons[edButtons.length] = new edButton('tws_two_fifth',
		
			'2/5',
			'[two_fifth] ',
			'[/two_fifth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_three_fifth_first',
		
			'3/5 First',
			'[three_fifth_first] ',
			'[/three_fifth_first]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_three_fifth',
		
			'3/5',
			'[three_fifth] ',
			'[/three_fifth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_four_fifth_first',
		
			'4/5 First',
			'[four_fifth_first] ',
			'[/four_fifth_first]'
		
		);
			
		edButtons[edButtons.length] = new edButton('tws_four_fifth',
		
			'4/5',
			'[four_fifth] ',
			'[/four_fifth]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_button',
		
			'Brn Btn',
			'[button] ',
			'[/button]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_map',
		
			'Brn Map Btn',
			'[brown_button_map link="#"] ',
			'[/brown_button_map]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_mail',
		
			'Brn Mail Btn',
			'[brown_button_mail link="#"] ',
			'[/brown_button_mail]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_drink',
		
			'Brn Drink Btn',
			'[brown_button_drink link="#"] ',
			'[/brown_button_drink]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_book',
		
			'Brn Book Btn',
			'[brown_button_book link="#"] ',
			'[/brown_button_book]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_ipod',
		
			'Brn iPod Btn',
			'[brown_button_ipod link="#"] ',
			'[/brown_button_ipod]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_gallery',
		
			'Brn Gallery Btn',
			'[brown_button_gallery link="#"] ',
			'[/brown_button_gallery]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_headphones',
		
			'Brn Headphones Btn',
			'[brown_button_headphones link="#"] ',
			'[/brown_button_headphones]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_download',
		
			'Brn Download Btn',
			'[brown_button_download link="#"] ',
			'[/brown_button_download]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_brown_button_information',
		
			'Brn Information Btn',
			'[brown_button_information link="#"] ',
			'[/brown_button_information]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_button_reverse',
		
			'Blu Btn',
			'[button_reverse] ',
			'[/button_reverse]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_map',
		
			'Blu Map Btn',
			'[blue_button_map link="#"] ',
			'[/blue_button_map]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_mail',
		
			'Blu Mail Btn',
			'[blue_button_mail link="#"] ',
			'[/blue_button_mail]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_drink',
		
			'Blu Drink Btn',
			'[blue_button_drink link="#"] ',
			'[/blue_button_drink]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_book',
		
			'Blu Book Btn',
			'[blue_button_book link="#"] ',
			'[/blue_button_book]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_ipod',
		
			'Blu iPod Btn',
			'[blue_button_ipod link="#"] ',
			'[/blue_button_ipod]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_gallery',
		
			'Blu Gallery Btn',
			'[blue_button_gallery link="#"] ',
			'[/blue_button_gallery]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_headphones',
		
			'Blu Headphones Btn',
			'[blue_button_headphones link="#"] ',
			'[/blue_button_headphones]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_download',
		
			'Blu Download Btn',
			'[blue_button_download link="#"] ',
			'[/blue_button_download]'
		
		);
		
		edButtons[edButtons.length] = new edButton('tws_blue_button_information',
		
			'Blu Information Btn',
			'[blue_button_information link="#"] ',
			'[/blue_button_information]'
		
		);
		

	</script>
<?php }	

?>