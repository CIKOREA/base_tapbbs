<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Install_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        // --------------------------------------------------------------------

        /**
         * drop_trigger
         *
         * @param string $trigger
         *
         * @return bool
         */
        private function drop_trigger($trigger)
        {
            $query = 'DROP TRIGGER IF EXISTS `'.$trigger.'`';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_setting_revision
         */
        public function create_trigger_by_update_setting_revision()
        {
            $this->drop_trigger('by_update_setting_revision');

            $query = '
CREATE TRIGGER by_update_setting_revision AFTER UPDATE ON tb_setting
    FOR EACH ROW
    BEGIN
        IF OLD.value != NEW.value THEN
            INSERT INTO tb_setting_revision (setting_idx, parameter, value, exec_user_idx, timestamp, client_ip)
            VALUES (OLD.idx, OLD.parameter, NEW.value, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_setting_revision
         */
        public function create_trigger_by_insert_setting_revision()
        {
            $this->drop_trigger('by_insert_setting_revision');

            $query = '
CREATE TRIGGER by_insert_setting_revision AFTER INSERT ON tb_setting
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_setting_revision (setting_idx, parameter, value, exec_user_idx, timestamp, client_ip)
        VALUES (NEW.idx, NEW.parameter, NEW.value, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_bbs_setting_revision
         */
        public function create_trigger_by_insert_bbs_setting_revision()
        {
            $this->drop_trigger('by_insert_bbs_setting_revision');

            $query = '
CREATE TRIGGER by_insert_bbs_setting_revision AFTER INSERT ON tb_bbs_setting
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_bbs_setting_revision (bbs_idx, setting_idx, parameter, value, exec_user_idx, timestamp, client_ip)
        VALUES (NEW.bbs_idx, NEW.idx, NEW.parameter, NEW.value, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_setting_revision
         */
        public function create_trigger_by_update_bbs_setting_revision()
        {
            $this->drop_trigger('by_update_setting_revision');

            $query = '
CREATE TRIGGER by_update_bbs_setting_revision AFTER UPDATE ON tb_bbs_setting
    FOR EACH ROW
    BEGIN
        IF OLD.value != NEW.value THEN
            INSERT INTO tb_bbs_setting_revision (bbs_idx, setting_idx, parameter, value, exec_user_idx, timestamp, client_ip)
            VALUES (OLD.bbs_idx, OLD.idx, OLD.parameter, NEW.value, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_bbs_category_revision
         */
        public function create_trigger_by_insert_bbs_category_revision()
        {
            $this->drop_trigger('by_insert_bbs_category_revision');

            $query = '
CREATE TRIGGER by_insert_bbs_category_revision AFTER INSERT ON tb_bbs_category
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_bbs_category_revision (bbs_idx, category_idx, category_name, sequence, exec_user_idx, timestamp, client_ip, is_used)
        VALUES (NEW.bbs_idx, NEW.idx, NEW.category_name, sequence, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip, NEW.is_used);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_bbs_category_revision
         */
        public function create_trigger_by_update_bbs_category_revision()
        {
            $this->drop_trigger('by_update_bbs_category_revision');

            $query = '
CREATE TRIGGER by_update_bbs_category_revision AFTER UPDATE ON tb_bbs_category
    FOR EACH ROW
    BEGIN
        IF OLD.category_name != NEW.category_name OR OLD.is_used != NEW.is_used OR OLD.sequence != NEW.sequence THEN
            INSERT INTO tb_bbs_category_revision (bbs_idx, category_idx, category_name, sequence, exec_user_idx, timestamp, client_ip, is_used)
            VALUES (OLD.bbs_idx, OLD.idx, NEW.category_name, NEW.sequence, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip, NEW.is_used);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_users_group_revision
         */
        public function create_trigger_by_insert_users_group_revision()
        {
            $this->drop_trigger('by_insert_users_group_revision');

            $query = '
CREATE TRIGGER by_insert_users_group_revision AFTER INSERT ON tb_users_group
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_users_group_revision (group_idx, group_name, icon_path, exec_user_idx, timestamp, client_ip, is_used)
        VALUES (NEW.idx, NEW.group_name, NEW.icon_path, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip, NEW.is_used);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_users_group_revision
         */
        public function create_trigger_by_update_users_group_revision()
        {
            $this->drop_trigger('by_update_users_group_revision');

            $query = '
CREATE TRIGGER by_update_users_group_revision AFTER UPDATE ON tb_users_group
    FOR EACH ROW
    BEGIN
        IF OLD.group_name != NEW.group_name OR OLD.icon_path != NEW.icon_path OR OLD.is_used != NEW.is_used THEN
            INSERT INTO tb_users_group_revision (group_idx, group_name, icon_path, exec_user_idx, timestamp, client_ip, is_used)
            VALUES (OLD.idx, NEW.group_name, NEW.icon_path, NEW.exec_user_idx, UNIX_TIMESTAMP(NOW()), NEW.client_ip, NEW.is_used);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_bbs_article_revision
         */
        public function create_trigger_by_insert_bbs_article_revision()
        {
            $this->drop_trigger('by_insert_bbs_article_revision');

            $query = '
CREATE TRIGGER by_insert_bbs_article_revision AFTER INSERT ON tb_bbs_article
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_bbs_article_revision (bbs_idx, article_idx, category_idx, exec_user_idx, title, timestamp, client_ip, is_notice, is_secret, is_deleted)
        VALUES (NEW.bbs_idx, NEW.idx, NEW.category_idx, NEW.exec_user_idx, NEW.title, UNIX_TIMESTAMP(NOW()), NEW.client_ip_insert, NEW.is_notice, NEW.is_secret, NEW.is_deleted);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_bbs_article_revision
         */
        public function create_trigger_by_update_bbs_article_revision()
        {
            $this->drop_trigger('by_update_bbs_article_revision');

            $query = '
CREATE TRIGGER by_update_bbs_article_revision AFTER UPDATE ON tb_bbs_article
    FOR EACH ROW
    BEGIN
        IF OLD.bbs_idx != NEW.bbs_idx OR OLD.category_idx != NEW.category_idx OR OLD.title != NEW.title OR OLD.is_notice != NEW.is_notice OR OLD.is_secret != NEW.is_secret OR OLD.is_deleted != NEW.is_deleted THEN
            INSERT INTO tb_bbs_article_revision (bbs_idx, article_idx, category_idx, exec_user_idx, title, timestamp, client_ip, is_notice, is_secret, is_deleted)
            VALUES (NEW.bbs_idx, OLD.idx, NEW.category_idx, NEW.exec_user_idx, NEW.title, UNIX_TIMESTAMP(NOW()), NEW.client_ip_update, NEW.is_notice, NEW.is_secret, NEW.is_deleted);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_bbs_contents_revision
         */
        public function create_trigger_by_insert_bbs_contents_revision()
        {
            $this->drop_trigger('by_insert_bbs_contents_revision');

            $query = '
CREATE TRIGGER by_insert_bbs_contents_revision AFTER INSERT ON tb_bbs_contents
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_bbs_contents_revision (bbs_idx, article_idx, contents_idx, exec_user_idx, contents, timestamp, client_ip)
        VALUES (NEW.bbs_idx, NEW.article_idx, NEW.idx, NEW.exec_user_idx, NEW.contents, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_bbs_contents_revision
         */
        public function create_trigger_by_update_bbs_contents_revision()
        {
            $this->drop_trigger('by_update_bbs_contents_revision');

            $query = '
CREATE TRIGGER by_update_bbs_contents_revision AFTER UPDATE ON tb_bbs_contents
    FOR EACH ROW
    BEGIN
        IF OLD.bbs_idx != NEW.bbs_idx OR OLD.contents != NEW.contents THEN
            INSERT INTO tb_bbs_contents_revision (bbs_idx, article_idx, contents_idx, exec_user_idx, contents, timestamp, client_ip)
            VALUES (NEW.bbs_idx, OLD.article_idx, OLD.idx, NEW.exec_user_idx, NEW.contents, UNIX_TIMESTAMP(NOW()), NEW.client_ip);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_insert_bbs_comment_revision
         */
        public function create_trigger_by_insert_bbs_comment_revision()
        {
            $this->drop_trigger('by_insert_bbs_comment_revision');

            $query = '
CREATE TRIGGER by_insert_bbs_comment_revision AFTER INSERT ON tb_bbs_comment
    FOR EACH ROW
    BEGIN
        INSERT INTO tb_bbs_comment_revision (bbs_idx, article_idx, comment_idx, exec_user_idx, comment, timestamp, client_ip, is_deleted)
        VALUES (NEW.bbs_idx, NEW.article_idx, NEW.idx, NEW.exec_user_idx, NEW.comment, UNIX_TIMESTAMP(NOW()), NEW.client_ip_insert, NEW.is_deleted);
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }

        // --------------------------------------------------------------------

        /**
         * by_update_bbs_comment_revision
         */
        public function create_trigger_by_update_bbs_comment_revision()
        {
            $this->drop_trigger('by_update_bbs_comment_revision');

            $query = '
CREATE TRIGGER by_update_bbs_comment_revision AFTER UPDATE ON tb_bbs_comment
    FOR EACH ROW
    BEGIN
        IF OLD.bbs_idx != NEW.bbs_idx OR OLD.comment != NEW.comment OR OLD.is_deleted != NEW.is_deleted THEN
            INSERT INTO tb_bbs_comment_revision (bbs_idx, article_idx, comment_idx, exec_user_idx, comment, timestamp, client_ip, is_deleted)
            VALUES (NEW.bbs_idx, OLD.article_idx, OLD.idx, NEW.exec_user_idx, NEW.comment, UNIX_TIMESTAMP(NOW()), NEW.client_ip_update, NEW.is_deleted);
        END IF;
    END;
            ';

            $query = $this->db->query($query);

            return $query;
        }
    }

//EOF