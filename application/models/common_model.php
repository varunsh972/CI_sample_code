<?php

/**
 * Created by PhpStorm.
 * Date: 25/5/15
 * Time: 5:13 PM
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_data($conditions, $params) {
        if (empty($params['table']) && empty($conditions)) {
            return;
        }
        if (!empty($params['batch_mode']) && $params['batch_mode'] == true) {
            $this->db->insert_batch($params['table'], $conditions);
        } else {
            $this->db->insert($params['table'], $conditions);
        }
        if ($this->db->insert_id()) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function get_data($conditions, $params = null) {

        if (!empty($params['complex']) && $params['complex'] == true) {
            if (!empty($conditions['on']) && !empty($conditions['tables'])) {

                foreach ($conditions['on'] as $key => $value) {
                    if (!empty($value['join']) && $value['join'] == 'left' && isset($value['has_condition']) && $value['has_condition'] == true) {
                        $this->db->join("{$conditions['tables'][$key]} AS $key", "$key.{$value['column']} {$value['sign']} {$value['alias_other']}.{$value['alias_column']}  AND attendees.status = 1", 'left');
                    } else if (!empty($value['join']) && $value['join'] == 'left') {
                        $this->db->join("{$conditions['tables'][$key]} AS $key", "$key.{$value['column']} {$value['sign']} {$value['alias_other']}.{$value['alias_column']}", 'left');
                    } else if (!empty($value['join']) && $value['join'] == 'right') {
                        $this->db->join("{$conditions['tables'][$key]} AS $key", "$key.{$value['column']} {$value['sign']} {$value['alias_other']}.{$value['alias_column']}", 'right');
                    } else {
                        $this->db->join("{$conditions['tables'][$key]} AS $key", "$key.{$value['column']} {$value['sign']} {$value['alias_other']}.{$value['alias_column']}");
                    }
                }
                if (!empty($conditions['where'])) {
                    foreach ($conditions['where'] as $key => $value) {
                        $val = $value['value'];
                        $join_key = "{$value['alias']}.$key";
                        if (!empty($val) && is_array($val)) {
                            $val['operator'] = !empty($val['operator']) ? $val['operator'] : 'AND';
                            if ($val['operator'] == 'AND') {
                                if ($val['sign'] == 'LIKE') {
                                    $this->db->like($join_key, $val['value']);
                                } else if ($val['sign'] == 'NULL') {
                                    $this->db->where("{$join_key} IS NULL");
                                } else if ($val['sign'] == 'NOT NULL') {
                                    $this->db->where("{$join_key} IS NOT NULL");
                                } else if ($val['sign'] == 'spl_where') {
                                    $this->db->where($val['value'], NULL, FALSE);
                                } else {
                                    $this->db->where($join_key . ' ' . $val['sign'], $val['value']);
                                }
                            } else if ($val['operator'] == 'OR') {
                                if ($val['sign'] == 'LIKE') {
                                    $this->db->or_like($join_key, $val['value']);
                                } else if ($val['sign'] == 'NULL') {
                                    $this->db->or_where("{$join_key} IS NULL");
                                } else if ($val['sign'] == 'spl_where') {
                                    $this->db->where($val['value'], NULL, FALSE);
                                }elseif($val['sign']=='ORWHERE'){
                                    //echo '<pre>';print_r($join_key);die;
                                    //"(event.user_id = '41' or (attendees.user_id = 41))"
                                    $this->db->where("(event.user_id = ".$val['value']." OR ".$join_key."=".$val['value'].")");
                                }
                                else {
                                    $this->db->or_where($join_key . ' ' . $val['sign'], $val['value']);
                                }
                            } else if ($val['operator'] == 'IN') {
                               //echo '<pre>';print_r($val['value']);die;
                                $this->db->where_in($join_key, $val['value']);
                            }
                        } else {
                            $this->db->where($join_key, $val);
                        }
                    }
                }
                if (!empty($conditions['having'])) {
                    foreach ($conditions['having'] as $key => $value) {
                        //$val = $value['having'];
                        $val = $value;
                        $join_key = $key;
                        if (!empty($val) && is_array($val)) {
                            $val['operator'] = !empty($val['operator']) ? $val['operator'] : 'AND';
                            if ($val['operator'] == 'AND') {

                                if ($val['sign'] == 'NULL') {
                                    $this->db->having("{$join_key} IS NULL");
                                } else if ($val['sign'] == 'NOT NULL') {
                                    $this->db->having("{$join_key} IS NOT NULL");
                                } else if ($val['sign'] == 'spl_having') {
                                    $this->db->having($val['value'], NULL, FALSE);
                                } else {
                                    $this->db->having($join_key . ' ' . $val['sign'], $val['value']);
                                }
                            } else if ($val['operator'] == 'OR') {
                                if ($val['sign'] == 'NULL') {
                                    $this->db->or_having("{$join_key} IS NULL");
                                } else if ($val['sign'] == 'spl_where') {
                                    $this->db->or_having($val['value'], NULL, FALSE);
                                } else {
                                    $this->db->or_having($join_key . ' ' . $val['sign'], $val['value']);
                                }
                            }
                        } else {
                            $this->db->having($join_key, $val);
                        }
                    }
                }

                if (isset($params['limit']) && isset($params['offset'])) {
                    $this->db->limit($params['limit'], $params['offset']);
                }
                if (!empty($params['fields'])) {
                    $this->db->select($params['fields']);
                }
                if (!empty($params['order_by'])) {
                    $this->db->order_by($params['order_by']);
                }
                if (!empty($params['group_by'])) {
                    $this->db->group_by($params['group_by']);
                }
                $table_key = $conditions['table'];
                $table_name = $conditions['tables'][$table_key];
                if (isset($params['print_query']) && $params['print_query'] == true) {
                    $query = $this->db->get("{$table_name} AS {$table_key}");
                    echo $this->db->last_query();
                    die();
                }
                if (isset($params['cnt']) && $params['cnt'] == 1) {
                    return $this->db->count_all_results("{$table_name} AS {$table_key}");
                }
                $query = $this->db->get("{$table_name} AS {$table_key}");

                if (!empty($params['single_row']) && $params['single_row'] == true) {
                    $result = $query->row();
                    $query->free_result();
                    return $result;
                }
                $result = $query->result();
                $query->free_result();
                return $result;
            }
        } else {
            if (empty($params) && empty($params['table'])) {
                return;
            }
            if (!empty($conditions)) {
                foreach ($conditions as $key => $val) {
                    if (!empty($val) && is_array($val)) {
                        $val['operator'] = !empty($val['operator']) ? $val['operator'] : 'AND';
                        if ($val['operator'] == 'AND') {
                            if ($val['sign'] == 'LIKE') {
                                $this->db->like($val['key'], $val['value']);
                            } else {
                                $this->db->where($val['key'] . ' ' . $val['sign'], $val['value']);
                            }
                        } else if ($val['operator'] == 'OR') {
                            if ($val['sign'] == 'LIKE') {
                                $this->db->or_like($val['key'], $val['value']);
                            } else {
                                $this->db->or_where($val['key'] . ' ' . $val['sign'], $val['value']);
                            }
                        }
                    } else if (isset($params['word']) && !empty($params['word'])) {
                        $this->db->where($conditions['orwhere']);
                    } else {
                        $this->db->where($key, $val);
                    }
                }
            }
            if (isset($params['cnt']) && $params['cnt'] == true) {
                return $this->db->count_all_results($params['table']);
            }
            if (!empty($params['fields'])) {
                $this->db->select($params['fields']);
            }
            if (!empty($params['group_by'])) {
                $this->db->group_by($params['group_by']);
            }
            if (isset($params['limit']) && isset($params['offset'])) {
                $this->db->limit($params['limit'], $params['offset']);
            }
            if (!empty($params['order_by'])) {
                $this->db->order_by($params['order_by']);
            }
            if (isset($params['single_row']) && $params['single_row'] == true) {
                $query = $this->db->get($params['table']);
                $result = $query->row();
                $query->free_result();
                return $result;
            }
            $query = $this->db->get($params['table']);
            //echo $this->db->last_query();
            //die();
            $result = $query->result();
            $query->free_result();
            return $result;
        }
    }

    public function get_countries() {
        $query = $this->db->get("barf_countries");
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    public function get_country($country_id) {
        if (empty($country_id)) {
            return false;
        }
        $this->db->where("id", $country_id);
        $query = $this->db->get("barf_bar_category");
        $result = $query->row();
        $query->free_result();
        return $result;
    }

    public function update($conditions, $params) {
        if (empty($conditions['value']) && empty($params['table'])) {
            return;
        }
        $params['batch_mode'] = isset($params['batch_mode']) ? $params['batch_mode'] : false;
        if (!empty($conditions['where'])) {
            if (is_array($conditions['where'])) {
                foreach ($conditions['where'] as $key => $value) {
                    if (is_array($value)) {
                        $this->db->where_in($key, $value);
                    } elseif (!empty($value)) {
                        $this->db->where($key, $value);
                    }
                }
            }
        }
        if ($params['batch_mode'] === false) {
            $this->db->update($params['table'], $conditions['value']);
        }
    }

    public function delete($conditions, $params) {
        if (empty($conditions) && empty($params['table'])) {
            return;
        }
        $this->db->delete($params['table'], $conditions);
    }

    public function delete_my_categories($user_id, $arr) {
        $this->db->where('user_id', $user_id);
        $this->db->where_in('category_id', $arr);
        $this->db->delete('who_categories_relation');
    }

    public function delete_my_cars($user_id, $arr) {
        $this->db->where('user_id', $user_id);
        $this->db->where_in('car_id', $arr);
        $this->db->delete('tbl_cars_relation');
    }

    public function delete_my_companies($user_id, $arr) {
        $this->db->where('user_id', $user_id);
        $this->db->where_in('business_id', $arr);
        $this->db->delete('who_user_companies');
    }

    public function delete_event_photos($arr) {
        $this->db->where_in('id', $arr);
        $this->db->delete('who_event_photos');
        return true;
    }

    public function get_photos($photo_array) {
        $this->db->select('*');
        $this->db->from(" who_event_photos");
        $this->db->where_in('id', $photo_array);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /**
     * getState : get state for given country
     * @author: jasbir singh
     * @param : country_id
     */
    public function getState($id) {
        $this->db->select('StateID,StateName');
        $ifExist = $this->db->get_where('da_state', array('CountryID' => 1));
        if ($ifExist->num_rows() > 0) {
            return $ifExist->result();
        }
    }

    /**
     * getState : get city for given state
     * @author: jasbir singh
     * @param : state_id
     */
    public function getCity($id) {
        $this->db->select('CityID,CityName');
        $ifExist = $this->db->get_where('da_cities', array('StateID' => $id));
        if ($ifExist->num_rows() > 0) {
            return $ifExist->result();
        }
    }
    
      /**
     * getState : get city for given state
     * @author: jasbir singh
     * @param : state_id
     */
    public function getCars() {
        $query = $this->db->get("tbl_cars");
        $result = $query->result();
        $query->free_result();
        return $result;
    }

    /**
     * getState : get city for given state
     * @author: jasbir singh
     * @param : state_id
     */
    public function get_category_name($id) {
        $this->db->select('name');
        $ifExist = $this->db->get_where('who_categories', array('id' => $id));
        if ($ifExist->num_rows() > 0) {
            return $ifExist->result();
        }
    }

    /**
     * checkFriend : check if mutual friend
     * @author: jasbir singh
     * @param : $login_id,$user_id
     */
    public function checkFriend($login_id, $user_id) {
        $this->db->where("( friend_id = $login_id AND user_id = $user_id ) OR ( friend_id = $user_id AND user_id = $login_id )");
        $query = $this->db->get("who_friends");
        $result = $query->row();
        $query->free_result();
        return $result;
    }

    /**
     * countFriend : count total friends of user
     * @author: jasbir singh
     * @param : $login_id,$user_id
     */
    public function countFriends($login_id, $user_id) {
        $query = $this->db->query("SELECT DISTINCT
                                        count(U.id) as total_friends
                                    FROM
                                        who_friends F,
                                        who_user_details U

                                    WHERE
                                        CASE
                                            WHEN F.user_id = $user_id THEN F.friend_id = U.id
                                            WHEN F.friend_id = $user_id THEN F.user_id = U.id
                                        END
                                            AND (F.user_id = $user_id OR F.friend_id = $user_id) AND F.status = 1");
        $result = $query->row();
        $query->free_result();
        return $result;
    }

    /**
     * getFriendList : get friend list of user id passed
     * @author: jasbir singh
     * @param : $user_id
     */
    public function getFriendList($login_id, $user_id, $limit, $offset) {
        $members = array();
        $query = $this->db->query("SELECT DISTINCT
                                        (U.id),
                                            U.profile_photo,
                                            U.name
                                    FROM
                                        who_friends F,
                                        who_user_details U

                                    WHERE
                                        CASE
                                            WHEN F.user_id = $user_id THEN F.friend_id = U.id
                                            WHEN F.friend_id = $user_id THEN F.user_id = U.id
                                        END
                                            AND (F.user_id = $user_id OR F.friend_id = $user_id) AND F.status = 1 LIMIT $offset,$limit");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $members[$i]['userId'] = $row->id;
                $members[$i]['name'] = $row->name;
                if ($row->profile_photo == '') {
                    $imgurl = base_url(PROFILE_IMG) . '/profile.jpg';
                } else {
                    $imgurl = $row->profile_photo;
                }
                $members[$i]['profileImage'] = $imgurl;
                if ($login_id != $row->id) {
                    $check = $this->checkFriend($login_id, $row->id);
                }
                if (isset($check) && !empty($check)) {
                    if ($check->status == 0 && $check->user_id != $login_id) {
                        $is_friend = array('requestId' => $check->id, 'status' => $check->status, 'message' => 'Accept/Decline Request');
                    } elseif ($check->status == 0 && $check->user_id == $login_id) {
                        $is_friend = array('status' => $check->status, 'message' => 'Request Sent');
                    } else {
                        $is_friend = array('status' => $check->status, 'message' => 'Friend');
                    }
                } else if ($login_id == $row->id) {
                    $is_friend = array('status' => 1, 'message' => 'Friend');
                } else {
                    $is_friend = array('status' => '', 'message' => 'Add Friend');
                }

                $members[$i]['is_friend'] = $is_friend;
                $members[$i]['mutual_friends'] = $this->mutualFriends($user_id, $row->id, 1);
                $members[$i]['mutual_categories'] = $this->mutualCategories($user_id, $row->id, 1);
                $i++;
            }
        }
        return $members;
    }

    /**
     * mutualFriends : get common friends between two users
     * @param : $user_one, $user_two
     */
    public function mutualFriends($user_one, $user_two, $cnt = NULL) {
        $query = $this->db->query("SELECT 
                                        f.friend_id
                                    FROM
                                        who_friends AS f
                                            INNER JOIN
                                        who_friends AS mf ON f.friend_id = mf.friend_id
                                    WHERE
                                        f.user_id = $user_one AND f.status = 1
                                            AND mf.user_id = $user_two
                                            AND mf.status = 1
                                    UNION
                                    SELECT 
                                         f.user_id
                                    FROM
                                        who_friends AS f
                                            INNER JOIN
                                        who_friends AS mf ON f.user_id = mf.user_id
                                    WHERE
                                        f.friend_id = $user_one AND f.status = 1
                                            AND mf.friend_id = $user_two
                                            AND mf.status = 1
                                    ");
        if ($cnt == NULL) {
            
        } else {
            return $query->num_rows();
        }
    }

    /**
     * mutualCategories : get common categories between two users
     * @param : $user_one, $user_two
     */
    public function mutualCategories($user_one, $user_two, $cnt = NULL) {
        if ($cnt == NULL) {
            $this->db->select("c.category_id");
        } else {
            $this->db->select("count(c.category_id) as count");
        }
        $this->db->from(" who_categories_relation AS c");
        $this->db->join('who_categories_relation AS mc', 'c.category_id = mc.category_id', 'inner');
        $this->db->where(array('c.user_id' => $user_one, 'mc.user_id' => $user_two));
        $query = $this->db->get();
        $result = $query->result();
        $query->free_result();
        if ($cnt == NULL) {
            return $result;
        } else {
            return $result[0]->count;
        }
    }

    public function getEventPhotos($eventId, $limit, $photo_array = NULL) {
        $this->db->select(array('CONCAT("' . base_url(EVENT_FOLDER) . '/event_", event_id, "/", file_name) AS eventImage'));
        $this->db->from(" who_event_photos");
        if ($photo_array != NULL) {
            $this->db->where_in('id', $photo_array);
        } else {
            $this->db->where('event_id', $eventId);
            if (is_numeric($limit)) {
                $this->db->limit($limit);
            }
        }
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getSingleComment($id) {
        $this->db->select('comment');
        $ifExist = $this->db->get_where('who_event_comments', array('id' => $id));
        if ($ifExist->num_rows() > 0) {
            $comment = $ifExist->row();
            return $comment->comment;
        }
    }
    
     /**
     * getFriendList : get friend list of user id passed
     * @param : $user_id
     */
    public function getFriendIds($user_id, $limit, $offset) {
        $members = array();
        $query = $this->db->query("SELECT DISTINCT
                                        (U.id)
                                    FROM
                                        who_friends F,
                                        who_user_details U

                                    WHERE
                                        CASE
                                            WHEN F.user_id = $user_id THEN F.friend_id = U.id
                                            WHEN F.friend_id = $user_id THEN F.user_id = U.id
                                        END
                                            AND (F.user_id = $user_id OR F.friend_id = $user_id) AND F.status = 1 LIMIT $offset,$limit");
        if ($query->num_rows() > 0) {
            $i = 0;
            foreach ($query->result() as $row) {
                $members[] = $row->id;
                $i++;
            }
        }
        return $members;
    }
    
      /**
     * getState : get city for given state
     * @param : state_id
     */
public function getCities() {
        $query = $this->db->get("tbl_cities");
        $result = $query->result();
        $query->free_result();
        return $result;
    }

}
