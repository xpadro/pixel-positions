<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" />
        <x-forms.input label="Location" name="location" placeholder="New York" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="http://acme.com/jobs/ceo" />
        <x-forms.checkbox label="Feature (Costs extra)" name="featured" />

        <x-forms.divider />
        
        <x-forms.input label="Tags (comma separated)" name="tags" placeholder="video, education" />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>
</x-layout>