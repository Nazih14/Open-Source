ALTER TABLE `students` ADD COLUMN `admission_phase_id`  BIGINT(20) NOT NULL DEFAULT '0' COMMENT 'Gelombang Pendaftaran' AFTER `selection_result`;
CREATE INDEX index_achievements ON achievements(student_id) USING BTREE;
CREATE INDEX index_answers ON answers(question_id) USING BTREE;
CREATE INDEX index_class_group_settings ON class_group_settings(academic_year_id, class_group_id, student_id) USING BTREE;
CREATE INDEX index_class_groups ON class_groups(major_id) USING BTREE;
CREATE INDEX index_comments ON comments(comment_post_id) USING BTREE;
CREATE INDEX index_employees ON employees(
  spouse_employment
  , employment_status
  , employment_type
  , institutions_lifter
  , rank
  , salary_source
  , skills_laboratory
) USING BTREE;
CREATE INDEX index_files ON files(file_category_id) USING BTREE;
CREATE INDEX index_photos ON photos(photo_album_id) USING BTREE;
CREATE INDEX index_pollings ON pollings(answer_id) USING BTREE;
CREATE INDEX index_posts ON posts(post_author) USING BTREE;
CREATE INDEX index_registration_quotas ON registration_quotas(major_id) USING BTREE;
CREATE INDEX index_scholarships ON scholarships(student_id) USING BTREE;
CREATE INDEX index_students ON students(
  registration_number
  , full_name
  , first_choice
  , second_choice
  , major_id
  , admission_phase_id
) USING BTREE;
CREATE INDEX index_user_privileges ON user_privileges(user_group_id, module_id) USING BTREE;
CREATE INDEX index_users ON users(user_group_id, profile_id) USING BTREE;