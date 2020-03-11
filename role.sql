select
  `users`.*,
  ``.`role_id` as `pivot_role_id`,
  ``.`user_id` as `pivot_user_id`,
  ``.`created_by` as `pivot_created_by`,
  ``.`updated_by` as `pivot_updated_by`
from `users`
inner join `` on `users`.`id` = ``.`user_id`
where
  ``.`role_id` = 1 '
