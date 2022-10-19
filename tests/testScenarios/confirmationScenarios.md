##### FEATURE 
Other users (warehouse users) can confirm the returned products by clicking "Confirm".

**SCENARIO 1GWT**
GIVEN
under each previous post on the page, logged in user can confirm an announcement (a post)
WHEN
logged in user confirms an announcement by pressing the "confirm" button
THEN
the confirmed announcement gets an additional confirm count

**SCENARIO 1AAA**
ARRANGE
under each previous post on the page, authenticated user can submit a form to confirm an announcement (a post)
ACT
authenticated user submits form to confirm an accouncement
ASSERT
the confirmed announcement's count is aggregated once

**SCENARIO 2GWT**
GIVEN
under each previous post on the page, logged in user can confirm an announcement (a post)
WHEN
logged in user confirms an announcement by pressing the "confirm" button
THEN
the user who made the announcement gets an additional confirmed announcement count

**SCENARIO 2AAA**
ARRANGE
under each previous post on the page, authenticated user can submit a form to confirm an announcement (a post)
ACT
authenticated user submits form to confirm an accouncement
ASSERT
the user who made the announcement gets an additional confirmed announcement count