<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Customized Arrays
| -------------------------------------------------------------------
| This file contains arrays of used in website.  
|
*/
/*
 * Activity Level Bar
 */

$config['activity_level_bar'] = array(LOW, MEDIUM, HIGH, ALL);
$config['activity_level'] = array(LOW=>'Low', MEDIUM=>'Medium', HIGH=>'High');
$config['status'] = array('1'=>'Active', '2'=>'Inactive');


$config['wesbite_messages'] = array(
                                    'update' => '{{var}} is updated successful',
                                    'insert' => '{{var}} is added successful',
                                    'email_sent' => '{{var}} is sent successful',
                                    'email_fail' => '{{var}} is not sent',
                                    'error' => '{{var}} is not added',
                                    'upload' => '{{var}} is uploaded successfully',
                                    'success' => '{{var}} successfully',
                                    'error_placed' => '{{var}} not placed',

                                );
$config['lead_type'] = array(
                                    '0' => 'Web Form',
                                    '1' => 'Phone',
                                    '2' => 'Referral',
                                    '3' => 'Other'
                                );
/*
 * Contact Method Type
 */
$config['contact_methods'] = array(
                                    '1' => 'Phone',
                                    '2' => 'Email',
                                    '3' => 'Text Message',
                                    '4' => 'Written Letter',
                                    '5' => 'In Person',
                                    '6' => 'Other'
                                );
/*
 * Contact status Type
 */
$config['contact_status'] = array(
                                    '1' => 'No answer from Contact',
                                    '2' => 'Left VoiceMail',
                                    '3' => 'Left Message with Person',
                                    '4' => 'Contact Not Available',
                                    '5' => 'Sent Email',
                                    '6' => 'Sent Letter',
                                    '7' => 'Busy Phone',
                                    '8' => 'Invalid Phone Number'
                                );

$config['default_lead_details'] = array(
                                    'contact_status'=> '1',
                                    'contact_methods'=> '1',
                                    'yes'=>'yes'
                                    );
/*
 * Yes/No status Type
 */
$config['yes'] = array(
                    'yes'=>'Yes',
                    'no'=>'No'
                    );

/*
 * Best Time
 */
$config['best_time'] = array(
                    '1'=>'Morning',
                    '2'=>'Afternoon',
                    '3'=>'Evening',
                    '4'=>'Anytime'
                    );
/*
 * Lead Logs Messages
 */
$config['lead_logs'] = array(
                        'insert_lead'=>'Lead created',
                        'contact_history'=>'Contact information updated for lead',
                        'notes'=>'Note added for lead',
                        'category_update'=>'Lead category updated',
                        'upload_document'=>'Document uploaded',
                        'followup_update'=>'Followup Updated',
                        'followup_insert'=>'Followup Added',
                        'followup_delete'=>'Followup Deleted'
                    );
$config['months'] = array(
                        '1'=>'January',
                        '2'=>'February',
                        '3'=>'March',
                        '4'=>'April',
                        '5'=>'May',
                        '6'=>'June',
                        '7'=>'July',
                        '8'=>'August',
                        '9'=>'September',
                        '10'=>'October',
                        '11'=>'November',
                        '12'=>'December'
                        );
$config['days'] = array(
                        '1'=>'1',
                        '2'=>'2',
                        '3'=>'3',
                        '4'=>'4',
                        '5'=>'5',
                        '6'=>'6',
                        '7'=>'7',
                        '8'=>'8',
                        '9'=>'9',
                        '10'=>'10',
                        '11'=>'11',
                        '12'=>'12',
                        '13'=>'13',
                        '14'=>'14',
                        '15'=>'15',
                        '16'=>'16',
                        '17'=>'17',
                        '18'=>'18',
                        '19'=>'19',
                        '20'=>'20',
                        '21'=>'21',
                        '22'=>'22',
                        '23'=>'23',
                        '24'=>'24',
                        '25'=>'25',
                        '26'=>'26',
                        '27'=>'27',
                        '28'=>'28',
                        '29'=>'29',
                        '30'=>'30',
                        '31'=>'31',
                    );
$config['years'] = array(
                    '2015'=>'2015',
                    '2016'=>'2016',
                    '2017'=>'2017',
                    '2018'=>'2018',
                    '2019'=>'2019'
                    );
$config['time_hours'] = array(
                    '1'=>'1',
                    '2'=>'2',
                    '3'=>'3',
                    '4'=>'4',
                    '5'=>'5',
                    '6'=>'6',
                    '7'=>'7',
                    '8'=>'8',
                    '9'=>'9',
                    '10'=>'10',
                    '11'=>'11',
                    '12'=>'12',
                    );
$config['time_minutes'] = array(
                    '00'=>'00',
                    '01'=>'01',
                    '02'=>'02',
                    '03'=>'03',
                    '04'=>'04',
                    '05'=>'05',
                    '06'=>'06',
                    '07'=>'07',
                    '08'=>'08',
                    '09'=>'09',
                    '10'=>'10',
                    '11'=>'11',
                    '12'=>'12',
                    '13'=>'13',
                    '14'=>'14',
                    '15'=>'15',
                    '16'=>'16',
                    '17'=>'17',
                    '18'=>'18',
                    '19'=>'19',
                    '20'=>'20',
                    '21'=>'21',
                    '22'=>'22',
                    '23'=>'23',
                    '24'=>'24',
                    '25'=>'25',
                    '26'=>'26',
                    '27'=>'27',
                    '28'=>'28',
                    '29'=>'29',
                    '30'=>'30',
                    '31'=>'31',
                    '32'=>'32',
                    '33'=>'33',
                    '34'=>'34',
                    '35'=>'35',
                    '36'=>'36',
                    '37'=>'37',
                    '38'=>'38',
                    '39'=>'39',
                    '40'=>'40',
                    '41'=>'41',
                    '42'=>'42',
                    '43'=>'43',
                    '44'=>'44',
                    '45'=>'45',
                    '46'=>'46',
                    '47'=>'47',
                    '48'=>'48',
                    '49'=>'49',
                    '50'=>'50',
                    '51'=>'51',
                    '52'=>'52',
                    '53'=>'53',
                    '54'=>'54',
                    '55'=>'55',
                    '56'=>'56',
                    '57'=>'57',
                    '58'=>'58',
                    '59'=>'59',
                    );

$config['time_analog'] = array(
                            'am'=>'am',
                            'pm'=>'pm',
                            );

/*
 * Lead placed status
 */
$config['placed_status'] = array(
                            '1'=>'Placed',
                            '2'=>'Placed Elsewhere'
                            );
/*
 * Followup status
 */
$config['followup_status'] = array(
                            '1'=>'Upcoming',
                            '2'=>'Rescheduled',
                            '3'=>'Completed'
                            );
/*
 * Referred status info
 */
$config['referred_info'] = array(
                            '1'=>'Not Good Fit',
                            '2'=>'Financial Need',
                            //'3'=>'Duplicate Lead',
                            //'4'=>'Already Placed',
                            );
/*
 * Referred status
 */
$config['referred_status'] = array(
                            '1'=>'Referred',
                            '2'=>'Low Income'
                            );

/*
 * Report Type
 */
$config['report_type'] = array(
                            'reports'=>'Reports',
                            'web-form-reports'=>'Web Form Reports',
                            'phone-call-reports'=>'Phone Call Reports',
                            'referral-reports'=>'Received Referral Reports',
                            'lead-referral-reports'=>'Lead Referral Reports',
                            'placement-reports'=>'Placement Reports'
                            );

/*
 * Graph Type
 */
$config['graph_type'] = array(
                            'total_lead_graph'=>'graph_total',
                            'web_form_lead_graph'=>'graph_web_form',
                            'phone_lead_graph'=>'graph_phone',
                            'referral_lead_graph'=>'graph_referred',
                            'other_lead_graph'=>'graph_other',
                            'placements_lead_graph'=>'graph_placed'
                            );
