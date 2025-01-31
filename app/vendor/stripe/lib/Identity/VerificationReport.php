<?php

// File generated from our OpenAPI spec

namespace Voxel\Vendor\CloudPayments\Identity;

/**
 * A VerificationReport is the result of an attempt to collect and verify data from a user.
 * The collection of verification checks performed is determined from the <code>type</code> and <code>options</code>
 * parameters used. You can find the result of each verification check performed in the
 * appropriate sub-resource: <code>document</code>, <code>id_number</code>, <code>selfie</code>.
 *
 * Each VerificationReport contains a copy of any data collected by the user as well as
 * reference IDs which can be used to access collected images through the <a href="https://cloudpayments.com/docs/api/files">FileUpload</a>
 * API. To configure and create VerificationReports, use the
 * <a href="https://cloudpayments.com/docs/api/identity/verification_sessions">VerificationSession</a> API.
 *
 * Related guides: <a href="https://cloudpayments.com/docs/identity/verification-sessions#results">Accessing verification results</a>.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property null|string $client_reference_id A string to reference this user. This can be a customer ID, a session ID, or similar, and can be used to reconcile this verification with your internal systems.
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $document Result from a document check
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $id_number Result from an id_number check
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $options
 * @property null|\Voxel\Vendor\CloudPayments\CloudPaymentsObject $selfie Result from a selfie check
 * @property null|string $type Type of report.
 * @property null|string $verification_session ID of the VerificationSession that created this report.
 */
class VerificationReport extends \Voxel\Vendor\CloudPayments\ApiResource
{
    const OBJECT_NAME = 'identity.verification_report';

    use \Voxel\Vendor\CloudPayments\ApiOperations\All;
    use \Voxel\Vendor\CloudPayments\ApiOperations\Retrieve;

    const TYPE_DOCUMENT = 'document';
    const TYPE_ID_NUMBER = 'id_number';
}
