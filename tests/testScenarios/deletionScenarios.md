##### FEATURE 
Users have the option to delete their own posts (announcements about returns).

**SCENARIO 1GWT**
GIVEN
under each previous post from the logged in user on the page, logged in user has the option to delete his/her post by clicking the X button.
WHEN
logged in user clicks on the X button on one of his/her own post (announcement)
THEN
deleted post is no longer displayed on the homepage

**SCENARIO 1AAA**
ARRANGE
under each previous post from the authenticated user on the page, authenticated user has the option to delete his/her post (annoucement) by clicking the X button.
ACT
authenticated user clicks on the X button on one of his/her own post (announcement)
ASSERT
the post is marked as deleted in the post DB and it is removed from the homepage for all users

**SCENARIO 2GWT**
GIVEN
under each previous post from the logged in user on the page, logged in user has the option to delete his/her post by clicking the X button.
WHEN
logged in user clicks on the X button on one of his/her own post (announcement)
THEN
post count (number of announcements made by user) is deducted by one

**SCENARIO 2AAA**
ARRANGE
under each previous post from the authenticated user on the page, authenticated user has the option to delete his/her post (annoucement) by clicking the X button.
ACT
authenticated user clicks on the X button on one of his/her own post (announcement)
ASSERT
post count (number of announcements made by user) is deducted by one in the user DB