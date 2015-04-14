@api @post @media
Feature: Check the API for MediaBundle
  I want to test the full workflow through API calls

  Background:
    Given I am authenticating as "admin" with "admin" password

  # GET

  Scenario: Get all media
    When I send a GET request to "/api/media/media.xml"
    Then the response code should be 200
    And response should contain "xml" object
    And response should contain "Paris"
    And response should contain "Switzerland"

  # POST

  Scenario: Post new media (with errors)
    When I send a POST request to "/api/media/providers/sonata.media.provider.file/media.xml" with values:
      | description | My description |
      | enabled     | 1              |
    Then  the response code should be 400
    And response should contain "xml" object
    And response should contain "Validation Failed"
    And response should contain "This value should not be blank"

  Scenario: Post new media (with non-existing provider)
    When I send a POST request to "/api/media/providers/nonexisting/media.xml" with values:
      | description | My description |
      | enabled     | 1              |
    Then the response code should be 404
    And response should contain "xml" object
    And response should contain "unable to retrieve the provider named : `nonexisting`"

  Scenario: Media full workflow
    When I send a POST request to "/api/media/providers/sonata.media.provider.youtube/media.xml" with values:
      | name           | My media                                   |
      | description    | My description                             |
      | enabled        | 1                                          |
      | copyright      | My Copyright                               |
      | authorName     | Myself                                     |
      | context        | My Context                                 |
      | cdnIsFlushable | 1                                          |
      | binaryContent  | http://www.youtube.com/watch?v=3Daw0vxENCU |
    Then the response code should be 200
    And response should contain "xml" object
    And response should contain "created_at"
    And response should contain "Thomas Rabaix"
    And store the XML response identifier as "media_id"


    When I send a GET request to "/api/media/media/<media_id>.xml" using last identifier:
    Then the response code should be 200
    And response should contain "xml" object
    And response should contain "Thomas Rabaix"

    # PUT

    When I send a PUT request to "/api/media/media/<media_id>.xml" using last identifier with values:
      | name        | My new media name |
    Then the response code should be 200
    And response should contain "xml" object
    And response should contain "My new media name"

    When I send a GET request to "/api/media/media/<media_id>.xml" using last identifier:
    Then the response code should be 200
    And response should contain "xml" object
    And response should contain "My new media name"

    # DELETE

    When I send a DELETE request to "/api/media/media/<media_id>.xml" using last identifier:
    Then the response code should be 200
    And response should contain "xml" object
    Then response should contain "true"

    When I send a GET request to "/api/media/media/<media_id>.xml" using last identifier:
    Then the response code should be 404
    And response should contain "xml" object